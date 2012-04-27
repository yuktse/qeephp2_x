<?php
// $Id: dropdownlist.php 2014 2009-01-08 19:01:29Z dualface $

/**
 * 定义 Control_DropdownList 类
 *
 * @link http://qeephp.com/
 * @copyright Copyright (c) 2006-2009 Qeeyuan Inc. {@link http://www.qeeyuan.com}
 * @license New BSD License {@link http://qeephp.com/license/}
 * @version $Id: dropdownlist.php 2014 2009-01-08 19:01:29Z dualface $
 * @package webcontrols
 */

/**
 * Control_DropdownList 构造一个下拉列表框
 *
 * @author YuLei Liao <liaoyulei@qeeyuan.com>
 * @version $Id: dropdownlist.php 2014 2009-01-08 19:01:29Z dualface $
 * @package webcontrols
 */
class Control_DropdownList extends QUI_Control_Abstract
{
    function render()
    {
        $selected = $this->_extract('selected');
        $value = $this->_extract('value');
        $items = $this->_extract('items');

        /**
         * 增加$non_htmlspecialchars选项，有些情况不需要做htmlspecialchars转换。yuk
         */
        $non_htmlspecialchars = $this->_extract('non_htmlspecialchars');

        /**
         * 增加$emptyText和$emptyVal，通常用作提示，例如'emptyText' => '--请选择国籍--'。yuk
         */
        $emptyText = $this->_extract('emptyText');
        $emptyVal = $this->_extract('emptyVal');

        if (strlen($value) && strlen($selected) == 0) {
            $selected = $value;
        }

        if ($emptyText) {
            $items = array($emptyVal => $emptyText) + $items;
        }

        $out = '<select ';
        $out .= $this->_printIdAndName();
        $out .= $this->_printDisabled();
        $out .= $this->_printAttrs();
        $out .= ">\n";

        foreach ((array)$items as $value => $caption)
        {
            if (!$non_htmlspecialchars) {
                $value = htmlspecialchars($value);
                $caption = htmlspecialchars($caption);
            }
            $out .= '<option value="' . $value . '" ';
            if ($value == $selected && strlen($value) == strlen($selected)) {
                $out .= 'selected="selected" ';
            }
            $out .= '>';
            $out .= $caption;
            $out .= "</option>\n";
        }
        $out .= "</select>\n";

        return $out;
    }
}

