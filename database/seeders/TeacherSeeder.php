<?php

namespace Database\Seeders;

use App\Models\ArTeacher;
use App\Models\EnTeacher;
use App\Models\Teacher;
use App\Models\TeacherAr;
use App\Models\TeacherEn;
use Illuminate\Database\Seeder;

use function PHPSTORM_META\map;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $enTeachers = [
            [
                'teacher_image' => 'teachers/R0l7RktPwHoXekAgWw3j9OcTbspViqFvxLQyv24Z.jpg',
                'teacher_name' => 'John Smith',
                'teacher_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam hendrerit
                                arcu non leo faucibus porta. Proin sed mattis lectus, eu placerat est. Etiam gravida,
                                diam id elementum gravida, sem eros convallis ipsum, et placerat velit felis id nulla.',
                'teacher_subject' => 'Mathematics',
                'teacher_color' => '#fd5658',
                'teacher_country' => 'uae',
            ],
            [
                'teacher_image' => 'teachers/HAgF1reJCl43jrZ5wRW2eiQ3LUhWw8LfRGCv0idS.jpg',
                'teacher_name' => 'Emily Johnson',
                'teacher_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam hendrerit
                                arcu non leo faucibus porta. Proin sed mattis lectus, eu placerat est. Etiam gravida,
                                diam id elementum gravida, sem eros convallis ipsum, et placerat velit felis id nulla.',
                'teacher_subject' => 'English',
                'teacher_color' => '#fd8a56',
                'teacher_country' => 'sa',
            ],
            [
                'teacher_image' =>
                'teachers/FFDYdw2azRuQvkDogWgIa9MJYlKaPRApuyutDVKD.jpg',
                'teacher_name' => 'Michael Williams',
                'teacher_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam hendrerit
                                arcu non leo faucibus porta. Proin sed mattis lectus, eu placerat est. Etiam gravida,
                                diam id elementum gravida, sem eros convallis ipsum, et placerat velit felis id nulla.',
                'teacher_subject' => 'History',
                'teacher_color' => '#2077e7',
                'teacher_country' => 'both',
            ],
            [
                'teacher_image' =>
                'teachers/Z4NM9yN9acO0r37qexdFypT7aCUp3wgGoRCBjBi3.jpg',
                'teacher_name' => 'Emma Brown',
                'teacher_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam hendrerit
                                arcu non leo faucibus porta. Proin sed mattis lectus, eu placerat est. Etiam gravida,
                                diam id elementum gravida, sem eros convallis ipsum, et placerat velit felis id nulla.',
                'teacher_subject' => 'Biology',
                'teacher_color' => '#ffc050',
                'teacher_country' => 'uae',
            ],
        ];
        $arTeachers = [
            [
                'teacher_image' => 'teachers/R0l7RktPwHoXekAgWw3j9OcTbspViqFvxLQyv24Z.jpg',
                'teacher_name' => 'جون سميث',
                'teacher_description' => 'العميل مهم جدًا، العميل سيتبعه العميل. للمكتب
 القوس ليس بوابة الحلق . في الواقع، هو مستثمر عقاري. حتى الحامل
 ديام هذا العنصر حامل، وادي إيروس سيم نفسه، وبلاسرات يريد إثارة ذلك لا.',
                'teacher_subject' => 'الرياضيات',
                'teacher_color' => '#fd5658',
                'teacher_country' => 'uae',
            ],
            [
                'teacher_image' => 'teachers/HAgF1reJCl43jrZ5wRW2eiQ3LUhWw8LfRGCv0idS.jpg',
                'teacher_name' => 'إيميلي جونسون',
                'teacher_description' => 'العميل مهم جدًا، العميل سيتبعه العميل. للمكتب
 القوس ليس بوابة الحلق . في الواقع، هو مستثمر عقاري. حتى الحامل
 ديام هذا العنصر حامل، وادي إيروس سيم نفسه، وبلاسرات يريد إثارة ذلك لا.',
                'teacher_subject' => 'لغة إنجليزية',
                'teacher_color' => '#fd8a56',
                'teacher_country' => 'sa',
            ],
            [
                'teacher_image' =>
                'teachers/FFDYdw2azRuQvkDogWgIa9MJYlKaPRApuyutDVKD.jpg',
                'teacher_name' => 'إيما براون',
                'teacher_description' => 'العميل مهم جدًا، العميل سيتبعه العميل. للمكتب
 القوس ليس بوابة الحلق . في الواقع، هو مستثمر عقاري. حتى الحامل
 ديام هذا العنصر حامل، وادي إيروس سيم نفسه، وبلاسرات يريد إثارة ذلك لا.',
                'teacher_subject' => 'تاريخ',
                'teacher_color' => '#2077e7',
                'teacher_country' => 'both',
            ],
            [
                'teacher_image' =>
                'teachers/Z4NM9yN9acO0r37qexdFypT7aCUp3wgGoRCBjBi3.jpg',
                'teacher_name' => 'ميشيل موريس',
                'teacher_description' => 'العميل مهم جدًا، العميل سيتبعه العميل. للمكتب
 القوس ليس بوابة الحلق . في الواقع، هو مستثمر عقاري. حتى الحامل
 ديام هذا العنصر حامل، وادي إيروس سيم نفسه، وبلاسرات يريد إثارة ذلك لا.',
                'teacher_subject' => 'أحياء',
                'teacher_color' => '#ffc050',
                'teacher_country' => 'uae',
            ],
        ];
        array_map(function ($teacher) {
            EnTeacher::create($teacher);
        }, $enTeachers);
        array_map(function ($teacher) {
            ArTeacher::create($teacher);
        }, $arTeachers);
    }
}
