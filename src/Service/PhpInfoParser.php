<?php


namespace App\Service;

use OutCompute\PHPInfo\PHPInfo;

class PhpInfoParser
{

    private PHPInfo $phpInfo;

    public function __construct()
    {
        $this->phpInfo = new PHPInfo();
    }

    /**
     * Get all fields from phpinfo() parser
     * @param int $flags Optional flags for phpinfo() parameter
     * @return array phpinfo() as associative array
     */
    public function getAll(int $flags=INFO_ALL): array
    {
        return $this->getPhpInfo($flags);
    }

    /**
     * Get a single value from the phpinfo() parser by field name, JSON encoded if value is array
     * @param string $field Field name
     * @param int $flags Optional flags for phpinfo() parameter
     * @return string|null Field value
     */
    public function getFieldValue(string $field, int $flags=INFO_ALL): ?string
    {
        if( !isset($this->getPhpInfo($flags)[$field]) ) return null;
        $value = $this->getPhpInfo($flags)[$field];
        if(is_array($value)) return json_encode($value);
        return $value;
    }

    /**
     * Get output of phpinfo() parsed into assoc array
     * @param int $flags Optional flags parameter of phpinfo()
     * @return array Output of phpinfo() as assoc array
     */
    protected function getPhpInfo(int $flags=INFO_ALL): array
    {
        ob_start();
        phpinfo($flags);
        $buffer = ob_get_clean();
        $this->phpInfo->setText($buffer);
        return $this->phpInfo->get();
    }

}