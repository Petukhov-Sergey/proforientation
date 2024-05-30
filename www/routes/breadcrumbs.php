<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('editor.tests.index', function (BreadcrumbTrail $trail) {
$trail->push('Тесты', route('editor.tests.index'));
});

Breadcrumbs::for('editor.tests.create', function (BreadcrumbTrail $trail) {
$trail->parent('editor.tests.index');
$trail->push('Создать тест', route('editor.tests.create'));
});

Breadcrumbs::for('editor.tests.edit', function (BreadcrumbTrail $trail, $test) {
$trail->parent('editor.tests.index');
$trail->push($test->title, route('editor.tests.questions.index', $test));
});

Breadcrumbs::for('editor.tests.questions.index', function (BreadcrumbTrail $trail, $test) {
$trail->parent('editor.tests.index');
$trail->push($test->title, route('editor.tests.questions.index', $test));
$trail->push('Вопросы', route('editor.tests.questions.index', $test));
});

Breadcrumbs::for('editor.tests.questions.create', function (BreadcrumbTrail $trail, $test) {
$trail->parent('editor.tests.questions.index', $test);
$trail->push('Создать вопрос', route('editor.tests.questions.create', $test));
});

Breadcrumbs::for('editor.tests.questions.edit', function (BreadcrumbTrail $trail, $test, $question) {
$trail->parent('editor.tests.questions.index', $test);
$trail->push($question->content, route('editor.questions.answers.index', [$test, $question]));
});

Breadcrumbs::for('editor.questions.answers.index', function (BreadcrumbTrail $trail, $question) {
$trail->parent('editor.tests.questions.index', $question->test);
$trail->push($question->content, route('editor.questions.answers.index', $question));
$trail->push('Ответы', route('editor.questions.answers.index', $question));
});

Breadcrumbs::for('editor.questions.answers.create', function (BreadcrumbTrail $trail, $question) {
$trail->parent('editor.questions.answers.index', $question);
$trail->push('Создать ответ', route('editor.questions.answers.create', $question));
});

Breadcrumbs::for('editor.questions.answers.edit', function (BreadcrumbTrail $trail, $question, $answer) {
$trail->parent('editor.questions.answers.index', $question);
$trail->push($answer->content, route('editor.questions.answers.edit', [$question, $answer]));
});

Breadcrumbs::for('editor.tests.results.index', function (BreadcrumbTrail $trail, $test) {
$trail->parent('editor.tests.index');
$trail->push($test->title, route('editor.tests.edit', $test));
$trail->push('Результаты', route('editor.tests.results.index', $test));
});

Breadcrumbs::for('editor.tests.results.create', function (BreadcrumbTrail $trail, $test) {
$trail->parent('editor.tests.results.index', $test);
$trail->push('Создать результат', route('editor.tests.results.create', $test));
});

Breadcrumbs::for('editor.tests.results.edit', function (BreadcrumbTrail $trail, $test, $result) {
$trail->parent('editor.tests.results.index', $test);
$trail->push($result->title, route('editor.tests.results.edit', [$test, $result]));
});
