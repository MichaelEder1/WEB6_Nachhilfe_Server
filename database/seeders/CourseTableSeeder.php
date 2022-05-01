<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Program;
use Illuminate\Database\Seeder;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $course1 = new Course();
        $course1->course_name = "Web- und Hypermedia";
        $course1->semester = 2;
        $course1->code = "WHM2";
        $course1->image = "https://images.unsplash.com/photo-1550063873-ab792950096b";
        $course1->description = "Einführung in die Web-Entwicklung, Markup Sprachen und Style Sheets, Grundlagen Hypermedia, Navigationskonzepte, Web-Standards, HTML, XHTML, CSS, DOM, Umgang mit entsprechenden Werkzeugen.";

        /* add connection to program */
        $program1 = Program::all()->first();
        $course1->programs()->associate($program1);
        $course1->save();

        $course2 = new Course();
        $course2->course_name = "Softwareentwicklung mit modernen Plattformen";
        $course2->semester = 4;
        $course2->code = "SMP4";
        $course2->image = "https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc";
        $course2->description = "Programmierung mit der Java-Plattform von Oracle: Konzepte (insbesondere virtuelle Maschine und Java-Bytecode), Programmiersprache Java, Zeichenketten, Behälter und Algorithmen, Serialisierung, Parallelität mit-tels mehrere Ausführungsfäden (threads), verteilte Anwendungen mittels remote method invocation (RMI), Grafische Benutzeroberflächen für Anwendungen und Applets mittels abstract windowing tootlkit (AWT) und Java FX, Zugriff auf relationale Datenbanken mittels Java database connectivity (JDBC) und einfache serverseitige Programmierung mittels Servlets. Programmierung mit der .NET-Plattform von Microsoft: Konzepte (virtuelle Maschine mit gemeinsamem Typsystem und gemeinsamer Zwischensprache für verschiedene Programmiersprachen), Programmiersprache C#, Behälter, grafische Benutzeroberflächen mittels Windows.Forms.";

        /* add connection to program */
        $program2 = Program::all()->skip(1)->first();
        $course2->programs()->associate($program2);
        $course2->save();

        $course3 = new Course();
        $course3->course_name = "Hardwarenahe Programmierung";
        $course3->semester = 3;
        $course3->code = "HWP3";
        $course3->image = "https://images.unsplash.com/photo-1518770660439-4636190af475";
        $course3->description = "Die Programmierung von Embedded Systemen ist unterschiedliche zur Software Entwicklung auf PCs – sie wird daher Firmware genannt. Embedded Systems - wie z.B. Antiblockiersysteme bei Autos, Pulsmesser, elektrische Zahnbürsten, TV Fernbedienungen, … - verfügen über wenig Speicher und beschränkte Ressourcen. Aus diesem Grund erfolgt die Programmierung meistens in der Programmiersprache C.";

        /* add connection to program */
        $program3 = Program::all()->skip(2)->first();
        $course3->programs()->associate($program3);
        $course3->save();

        $course4 = new Course();
        $course4->course_name = "Media, Economy and Law";
        $course4->semester = 4;
        $course4->code = "MEL4";
        $course4->image = "https://images.unsplash.com/photo-1593444285553-28163240e3f1";
        $course4->description = "Vermittlung wichtiger Grundlagen rund um Unternehmen, Entrepreneurship und Selbstständigkeit: betriebliche Funktionsbereiche und Abläufe, Rech-nungswesen, Finanzbuchhaltung, Kalkulation und Finanzierung, Investitionen, Kostenrechnung, Controlling, Steuern, Personalkosten, Sozialversicherung, Rücklagen. Rechtsformen von Unternehmen, Entscheidungsstrukturen, Ver-tretungsbefugnisse, Gründung und Auflösung von Unternehmen. Wirtschaftli-che Aspekte von Medienunternehmen, Grundlagen der Preisgestaltung und Vertragsgestaltung mit Endkund*innen im Medienbereich.";

        /* add connection to program */
        $program4 = Program::all()->skip(3)->first();
        $course4->programs()->associate($program4);
        $course4->save();
    }
}
