<?php

declare(strict_types=1);

namespace app\repositories;

final class Repository
{
    const PROPERTY = 1;
    const DOCUMENT = 2;
    const STAFF = 3;
    const STUDENT = 4;

    const WORK = 1;
    const DONE = 2;
    const CANCEL = 3;
    
    
    const STUDENT_WORK = 1;
    const STUDENT_DONE = 2;
    const STUDENT_DISMISS = 3;

    /**
     * @return string[]
     */
    public function getCategories(): array
    {
        return [
            self::PROPERTY => 'имущество',
            self::DOCUMENT => 'документы',
            self::STAFF => 'персонал',
            self::STUDENT => 'обучающиеся',
        ];
    }

    /**
     * @return string[]
     */
    public function getStatuses(): array
    {
        return [
            self::WORK => 'в работе',
            self::DONE => 'завершен',
            self::CANCEL => 'отменен',
        ];
    }
    
    /**
     * @return string[]
     */
    public function getStudentStatuses(): array
    {
        return [
            self::STUDENT_WORK => 'учится',
            self::STUDENT_DONE => 'окончил обучение',
            self::STUDENT_DISMISS => 'отчислен',
        ];
    }

    /**
     * @param int|null $code
     * @return string
     */
    public function getCategory(?int $code): string
    {
        return self::getCategories()[$code] ?? "";
    }

    /**
     * @param int|null $code
     * @return string
     */
    public function getStatus(?int $code): string
    {
        return self::getStatuses()[$code] ?? "";
    }
}

