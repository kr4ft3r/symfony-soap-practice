<?php


namespace App\Service;

use OutCompute\PHPInfo\PHPInfo;

class PhpInfoParser
{
    public function getFieldValue(string $field, int $flags=INFO_ALL): string
    {
        return $this->getPhpInfo($flags)[$field];
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
        $phpInfo = new PHPInfo();
        $phpInfo->setText($buffer);
        return $phpInfo->get();
    }

}