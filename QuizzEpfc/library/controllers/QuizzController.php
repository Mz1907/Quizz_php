<?php

class QuizzController {

    public function highlightGoodAnswer($goodAnswer, $radioValue) {
        $style = 'style="border: solid 3px; padding: 3px; width: 25px; color: #00cc00; border-style: dotted;"';
        return $style = $radioValue == $goodAnswer ? $style : '';
    }

    public function highlightUserChoice($userPostedDatas, $radioValue, $i) {
        $userSelectedChoices = [];
        $style = 'style="border: solid 3px; padding: 3px; width: 25px; color: red; border-style: dotted;"';
        foreach ($userPostedDatas as $key => $value) {
            if (strpos($key, 'uChoice') === 0)
                $userSelectedChoices [] = $value;
        }
        if ($userSelectedChoices[$i] == $radioValue)
            return $style;
        else
            return '';
    }
}
