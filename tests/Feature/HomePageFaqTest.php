<?php

use App\Models\Faq;

it('renders active FAQs on the homepage', function () {
    Faq::query()->create([
        'question_en' => 'How do you manage large construction projects?',
        'answer_en'   => 'We coordinate planning, procurement, and execution with clear milestones.',
        'question_ar' => 'كيف تديرون المشاريع الإنشائية الكبيرة؟',
        'answer_ar'   => 'ننسق التخطيط والشراء والتنفيذ مع معالم واضحة.',
        'status'      => 1,
        'order'       => 1,
    ]);

    $response = $this->get('/en');

    $response->assertStatus(200);
    $response->assertSee('How do you manage large construction projects?');
});
