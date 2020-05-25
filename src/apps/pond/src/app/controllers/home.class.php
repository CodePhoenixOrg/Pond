<?php
namespace CodePhoenixOrg\Pond\pond\Controllers;

use CodePhoenixOrg\Pond\Framework\Web\Controller;

class Home extends Controller
{
    public function load(): ?array
    {
        return ["items" => [
                ["title" => "CodePhoenixOrg.fr pages", "url" => "pages.html?language=fr&country=FR&partner=7884&partnerid=110&projectid=15"],
                ["title" => "CodePhoenixOrg.fr products", "url" => "products.html?language=fr&country=FR&partner=7884&partnerid=110&projectid=15"],
                ["title" => "CodePhoenixOrg.fr placeholders", "url" => "placeholders.html?language=fr&country=FR&partner=7884&partnerid=110&projectid=15"],
                ["title" => "CodePhoenixOrg.fr noindex", "url" => "noindex.html"],
                ["title" => "CodePhoenixOrg.fr token", "url" => "token.html"],
            ]
        ];
    }
}
