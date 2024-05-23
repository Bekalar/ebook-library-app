<?php

namespace App\DataFixtures;

use App\Entity\Ebook;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Validator\Constraints\DateTime;

class EbookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach ($this->EbookData() as [$title, $description, $author, $created, $filename]) {
            $ebook = new Ebook;
            $ebook->setTitle($title);
            $ebook->setDescription($description);
            $ebook->setAuthor($author);
            $ebook->setCreated(new \DateTime($created));
            $ebook->setFilename($filename);

            $manager->persist($ebook);
        }
        $manager->flush();
    }

    private function EbookData()
    {
        return [
            ['Instalacje elektryczne', 'opis ksiązki', 'Henryk Makiewicz', '22-03-2024', 'adfegsdf'],
            ['Rysunek techniczny maszynowy', 'opis ksiązki', 'Tadeusz Dobrzański', '18-03-2024', 'fagsgdfh'],
            ['Elektrownie jądrowe', 'opis ksiązki', 'Jerzy Kubowski', '25-06-2023', 'ngkhdgfssdf'],
            ['Nowy poradnik majstra', 'opis ksiązki', 'Janusz Panas', '10-01-2021', 'ghsclawfsdg'],
            ['Obliczenia kwantowe dla każdego', 'opis ksiązki', 'Chris Bernhardt', '11-01-2021', 'ghsjdfssvyjtyu'],
            ['Praktyczne uczenie maszynowe', 'opis ksiązki', 'Marcin Szeliga', '05-04-2022', 'thsclawfsdg'],
            ['Akustyka w budownictwie', 'opis ksiązki', 'Jacek Nurzyński', '05-07-2023', 'acmpprvwrvldbd'],
            ['Teoria obwodów elektrycznych', 'opis ksiązki', 'Stanisław Bolkowski', '15-02-2024', 'ghsclawfsdg'],
            ['Balistyka dla snajperów', 'opis ksiązki', 'Jerzy A. Ejsmont', '25-08-2022', 'lhpmgjgwfsdg'],
            ['Mosty stalowe', 'opis ksiązki', 'Henryk Zobel, Thakaa Al-Khafaji', '30-09-2022', 'tyrhsclakouoipp'],
            ['Charnobyl i Fukushima', 'opis ksiązki', 'Tomasz Ilnicki', '01-04-2023', 'pfdrgosawdfyjvs'],
            ['Sieć średnich napięć', 'opis ksiązki', 'Witold Hoppel', '02-06-2024', 'sbpawdlbdopawud'],
            ['Innowacje w transporcie', 'opis ksiązki', 'Krystyna Wojewódzka-Król', '21-04-2024', 'adsibowaksd'],
            ['Sztuka argumentacji', 'opis ksiązki', 'Krzysztof Szymanek', '20-03-2023', 'sdgpqfjsal'],
            ['Geometria i trygonometria', 'opis ksiązki', '	Wojciech Guzicki', '05-05-2020', 'sgpasfjbapejfo'],
        ];
    }
}