<?php declare(strict_types=1);

return function (array $vars) {
    $archives = glob('/tmp/work1/*/*.zip');
    if (!$archives) {
        return 'アーカイブの保存がうまくいっていなそうです';
    }
    if (count($archives) !== 37) {
        return '保存されたアーカイブの数が想定数と異なります)';
    }
};
