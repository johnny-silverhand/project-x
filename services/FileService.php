<?php


namespace app\services;

use Yii;
use app\models\ResponseFile as File;
use yii\base\BaseObject;
use yii\base\InvalidArgumentException;
use yii\helpers\FileHelper;
use yii\base\Exception;
use DateTime;

final class FileService extends BaseObject
{
    /**
     * Пути файлов для удаления
     * @var array|File[]
     */
    private static array $filesForDel = [];

    /**
     * Путь до папки с файлами
     * @var string
     */
    private string $path = '';

    public function __construct(array $params = [])
    {
        if (!key_exists('path', $params)) {
            throw new InvalidArgumentException();
        }
        $this->path = $params['path'];
    }

    public function createDir(File $file): void
    {
        $path = $this->getFileDir($file);
        if (!file_exists($path)) {
            FileHelper::createDirectory($path);
        }
    }

    public function getFilePath(File $file): string
    {
        return $this->getFileDir($file) . $file->id;
    }

    public function getFileDir(File $file): string
    {
        $dir = intdiv($file->id, 1000) * 1000;
        return Yii::getAlias($this->path . $dir . '/');
    }

    public function addFileForDelete(array $files): void
    {
        static::$filesForDel = array_merge(static::$filesForDel, $files);
    }

    public function deletePreparedFiles(): void
    {
        foreach (static::$filesForDel as $file) {
            $file->delete();
        }
    }

    public function deleteFile(File $file): void
    {
        $fp = $this->getFilePath($file);
        if (file_exists($fp)) {
            unlink($fp);
        }
    }
}
