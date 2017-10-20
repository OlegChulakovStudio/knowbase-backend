# GEOIP
- Подключить и использовать компонент 
https://github.com/omnilight/yii2-sypexgeo
- Создать консольную команду для обновления базы Geoip. Пример
```php
namespace console\controllers;


use Yii;
use yii\console\Controller;
use yii\helpers\Console;


class UpdateGeoBaseController extends Controller
{
    protected $url = 'https://sypexgeo.net/files/SxGeoCity_utf8.zip';

    public function actionIndex()
    {
        $datFileDir = Yii::getAlias('@common/data/');
        $tmpDir =  Yii::getAlias('@console/runtime');

        $last_updated_file = Yii::getAlias('@common/data/') . 'SxGeo.upd';

        set_time_limit(600);

        header('Content-type: text/plain; charset=utf8');

        $datFile = 'SxGeoCity.dat';

        $this->stdout("Скачиваем архив с сервера. \r\n", Console::FG_GREEN);

        $fp = fopen($tmpDir . '/SxGeoTmp.zip', 'wb');
        $ch = curl_init($this->url);
        curl_setopt_array($ch, array(
            CURLOPT_FILE => $fp,
            CURLOPT_HTTPHEADER => file_exists($last_updated_file) ? array("If-Modified-Since: " . file_get_contents($last_updated_file)) : array(),
        ));
        if (!curl_exec($ch)) {
            $this->stdout("Ошибка при скачивании архива. \r\n", Console::FG_RED);
        }
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        fclose($fp);
        if ($code == 304) {
            @unlink($tmpDir . '/SxGeoTmp.zip');
            $this->stdout("Архив не обновился, с момента предыдущего скачивания. \r\n", Console::FG_RED);
            return;
        }

        $this->stdout("Архив с сервера скачан. \r\n", Console::FG_GREEN);

        $fp = fopen('zip://' . $tmpDir . '/SxGeoTmp.zip#' . $datFile, 'rb');
        $fw = fopen($tmpDir . '/' . $datFile, 'wb');
        if (!$fp) {
            $this->stdout("Не получается открыть. \r\n", Console::FG_RED);
        }

        stream_copy_to_stream($fp, $fw);
        fclose($fp);
        fclose($fw);

        if (filesize($tmpDir . '/' . $datFile) == 0) {
            $this->stdout("Не удалось распаковать архив. \r\n", Console::FG_RED);
        }
        @unlink($tmpDir . '/SxGeoTmp.zip');

        rename($tmpDir . '/' . $datFile, $datFileDir . $datFile);
        file_put_contents($last_updated_file, gmdate('D, d M Y H:i:s') . ' GMT');

        $this->stdout("Перемещен файл в {$datFileDir}{$datFile}\n", Console::FG_GREEN);
    }

}

```
- Настроить выполнение скрипта по cron
```
0 2 * * * user_name  /usr/bin/php  /path/to/yii update-geo-base
```
