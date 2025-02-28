<?php

namespace App\Actions;

use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\Storage;

class ReadFileAction
{
    public function read(string $fileName)
    {
        $contents = '';

        try {
            $filePath = Storage::disk('public')->path($fileName);
            if (str_ends_with($filePath, 'txt')) {
                return  file_get_contents($filePath);
            }
            $phpWord = IOFactory::load($filePath);
            $sections = $phpWord->getSections();
            foreach ($sections as $section) {
                $elements = $section->getElements();
                foreach ($elements as $element) {
                    if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                        foreach ($element->getElements() as $text) {
                            if ($text instanceof \PhpOffice\PhpWord\Element\Text) {
                                $contents = $contents . $text->getText() . PHP_EOL;
                            }
                        }
                    } elseif ($element instanceof \PhpOffice\PhpWord\Element\Text) {
                        $contents = $contents . $element->getText() . PHP_EOL;
                    }
                }
            }
        } catch (\Exception $e) {
            $contents .= PHP_EOL . $e->getMessage() . PHP_EOL;
        }
        return $contents;
    }
}
