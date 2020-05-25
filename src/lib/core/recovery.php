<?php

namespace CodePhoenixOrg\Pond\Framework\Core;

use CodePhoenixOrg\Pond\Framework\File\FileUtils;

final class Recovery
{
    private $_lastId = -1;

    public function getLastID(): int
    {
        return $this->_lastId;
    }

    public function resetLastID(): void
    {
        $this->_lastId = -1;
    }

    public function loadLastID(string $filename): int
    {
        $filename = FileUtils::outputDir() . $filename;
        if (!\file_exists($filename)) {
            return $this->getLastID();
        }

        $content = \file_get_contents($filename);
        $content = \str_replace("\r", '', $content);
        $content = \str_replace("\n", '', $content);
        $content = \trim($content);
        if (is_numeric($content)) {
            $this->_lastId = (int) $content;
        }

        return $this->getLastID();

    }

    public function saveLastID(string $filename, int $lastID): void
    {
        \file_put_contents($filename, $lastID);
    }

    public function destroyLastID(string $filename, ?int $lastID = null): void
    {
        if (\file_exists($filename) && ($lastID === null || $lastID < 1)) {
            \unlink($filename);
            $this->resetLastID();
        }
    }
}
