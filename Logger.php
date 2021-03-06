<?php

namespace App;
/**
 * Realizes logging into given file and working with that file
 */
class Logger
{
    private string $file;
    private string $last_insert = '';

    public function __construct(string $file)
    {
        if (!file_exists($file)) {
            $dirArr = explode('/', $file);
            array_pop($dirArr);
            $dir = '';
            foreach ($dirArr as $value) {
                $dir .= "$value/";
                if (!is_dir($dir))
                    mkdir($dir);
            }
            file_put_contents($file, '');
        }
        $this->file = $file;
    }

    /**
     * Write data into file
     * @param $data
     * @param bool $show_file
     * @param string $tz_id
     * @return bool
     */
    public function write($data, bool $show_file = false, string $tz_id = 'UTC'): bool
    {
        if(!date_default_timezone_set($tz_id))
            date_default_timezone_set('UTC');

        $input = '[' . ($show_file? __FILE__ . ' ' : '') . date('h:i:s Y-m-d') . ']' . PHP_EOL . print_r($data, true);

        if(!(file_put_contents($this->file, $input . PHP_EOL, FILE_APPEND | LOCK_EX) === false)) {
            $this->last_insert = $input;
            return  true;
        } else
            return false;
    }

    /**
     * Gets current file name or none
     * @return string|null
     */
    public function getFile(): ?string
    {
        return $this->file ? $this->file : null;
    }

    /**
     * Gets last insert into file
     * @return string
     */
    public function getLastInsert(): ?string
    {
        return $this->last_insert;
    }

    /**
     * Gets last $lines lines from file
     * @param int $lines
     * @param int $buffer
     * @return string
     */
    public function getLastLines(int $lines = 1, int $buffer = 4096): ?string
    {
        // Open the file
        $f = fopen($this->file, "rb");

        // Jump to last character
        fseek($f, -1, SEEK_END);

        // Read it and adjust line number if necessary
        // (Otherwise the result would be wrong if file doesn't end with a blank line)
        if ($a = fread($f, 1) != "\n")
            $lines -= 1;

        // Start reading
        $output = '';
        $chunk = '';

        // While we would like more
        while (ftell($f) > 0 && $lines >= 0) {
            // Figure out how far back we should jump
            $seek = min(ftell($f), $buffer);

            // Do the jump (backwards, relative to where we are)
            fseek($f, -$seek, SEEK_CUR);

            // Read a chunk and prepend it to our output
            $output = ($chunk = fread($f, $seek)) . $output;
            // Jump back to where we started reading
            fseek($f, -mb_strlen($chunk, '8bit'), SEEK_CUR);

            // Decrease our line counter
            $lines -= substr_count($chunk, "\n");
        }

        // While we have too many lines
        // (Because of buffer size we might have read too many)
        while ($lines++ < 0) {
            // Find first newline and remove all text before that
            $output = substr($output, strpos($output, "\n") + 1);
        }

        // Close file and return
        fclose($f);
        return $output ?? null;
    }
}

$logger = new Logger(__DIR__ . '/logs/test.log');
//$a = new Logger(__DIR__ . '/logs/test1.log');
$logger->write('asdsad');
$logger->write(['a' => 'anthem', 'b' => 'bulwark', 'c' => 'carolina'], true,'Europe/Moscow');
//var_dump($logger->getLastInsert());