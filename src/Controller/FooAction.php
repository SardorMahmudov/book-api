<?php

declare(strict_types=1);

namespace App\Controller;


use App\Repository\BookRepository;

class FooAction
{
    // repository orqali ma'lumot qidirish mumkin
    public function __invoke(BookRepository $bookRepository)
    {
        // 12 id li book ni ber.
        // javob sifatida Book enitysi qaytadi,
        // ma'lumotlar topilmas null qaytadi
        $book = $bookRepository->find(12);

        $book = $bookRepository->findOneBy(
            [
                'name' => 'hollywood',
                'description' => 'bla bla',
            ]
        );
    }
}