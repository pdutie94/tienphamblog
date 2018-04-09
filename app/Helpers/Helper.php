<?php
namespace App\Helpers;

class Helper {
    const STATE_PUBLISHED = 1;
    const STATE_UNPUBLISH = 0;
    public static function stateHtml($stateValue) {
        $html = '';
        if($stateValue == self::STATE_PUBLISHED) {
            $html = '<span class="state-box" data-toggle="tooltip" title="Đã xuất bản"><i class="state-icon state-icon-success icon-ok"></i></span>';
        }
        if($stateValue == self::STATE_UNPUBLISH) {
            $html = '<span class="state-box" data-toggle="tooltip" title="Chưa xuất bản"><i class="state-icon state-icon-unpublish icon-remove"></i></span>';
        }

        return $html;
    }
}