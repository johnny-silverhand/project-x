<?php

namespace app\services;
use app\models\Student;
use PHPHtmlParser\Dom;

/**
 * Класс для извлечения данных
 *
 * @author restlin
 */
class Extractor {
    private string $content;
    private array $labels = [];
    private Student $student;

    public function __construct(string $content) {
        $this->content = $content;
        $this->student = new Student();
    }

    public function searchData(): Student {
        $dom = new Dom;
        $dom->loadStr($this->content);
        if(false && ($tables = $dom->find('table')) && $tables->count()) {
            foreach($tables as $table) {
                if(!$this->searchInHorizontalTable($table)) {
                    $this->searchInVerticalTable($table);
                }
            }
        } elseif(($ps = $dom->find('p, div')) && $ps->count()) {
            foreach($ps as $p) {
                $this->searchInSentence($p->text);
            }
        } else {
            $sentences = explode('. ', $this->content);
            foreach($sentences as $sentence) {
                $this->searchInSentence($sentence);
            }
        }
        return $this->student;
    }
    private function searchInHorizontalTable(Dom\Node\HtmlNode $table) {
        $trs = $table->find('tr');
        $firstColumn = true;
        $labelIndexes = [];
        foreach($trs as $tr) {
            $tds = $tr->find('td, th');
            foreach($tds as $index => $td) {
                $text = $td->text;
                if($firstColumn) {
                    foreach($this->labels as $baseLabel) {
                        $label = ManyMorphologicHelper::wordManyCase($baseLabel, MorphologicHelper::NOMINATIVE);
                        if(mb_strpos($text, $label) !== false) {
                            $labelIndexes[$index] = $baseLabel;
                        }
                    }

                } elseif(preg_match("/\d+/ui", $text, $search) && key_exists($index, $labelIndexes)) {
                    $this->result[$labelIndexes[$index]] = $search[0];
                }
            }
            $firstColumn = false;
            if(count($labelIndexes) < 2) {
                return false;
            }
        }
        return true;
    }
    private function searchInVerticalTable(Dom\Node\HtmlNode $table) {
        $trs = $table->find('tr');
        foreach($trs as $tr) {
            $findedValue = null;
            $findedLabel = null;
            $tds = $tr->find('td, th');
            foreach($tds as $td) {
                $text = $td->text;
                foreach($this->labels as $baseLabel) {
                    $label = ManyMorphologicHelper::wordManyCase($baseLabel, MorphologicHelper::NOMINATIVE);
                    if(mb_strpos($text, $label) !== false) {
                        $findedLabel = $baseLabel;
                    } elseif(preg_match("/\d+/ui", $text, $search)) {
                        $findedValue = $search[0];
                    }
                }
            }
            if($findedLabel && $findedValue) {
                $this->result[$findedLabel] = $findedValue;
            }
        }
    }
    private function searchInSentence(string $sentence) {
        if(preg_match('/ФИО\W{1,10}(\w+.\W?\w.\w)/ui', $sentence, $search)) {
            $this->student->fio = $search[1];
        }
        if(preg_match('/(ДР|дата\W{1,5}рождения)\W{1,10}(\d{2}.\d{2}.\d{4})/ui', $sentence, $search)) {
            $this->student->birthdate = $search[2];
        }
        if(preg_match('/начал[оа] {1,10}обучения\W{1,10}(\d{2}.\d{2}.\d{4})/ui', $sentence, $search)) {
            $this->student->date_start = $search[1];
        }
        if(preg_match('/конец[оа] {1,10}обучения\W{1,10}(\d{2}.\d{2}.\d{4})/ui', $sentence, $search)) {
            $this->student->date_end = $search[1];
        }
        if(preg_match('/бюджет/ui', $sentence, $search)) {
            $this->student->budget = true;
        }
        if(preg_match('/сирот/ui', $sentence, $search)) {
            $this->student->orphan = true;
        }
    }
}
