=== Plugin Name ===
Contributors: BICMedia
Donate link: http://www.bic-media.com/dmr/index.jsp?nav=widget&nav2=wordpressplugin&lang=d
Tags: bic media, plugin, books, media, isbn, buch, b&#252;cher, h&#246;rbuch, h&#246;rprobe, leseprobe, volltextsuche, audiobuch, audiobook
Requires at least: 2.5
Tested up to: 2.5
Stable tag: 1.0

Das BIC Media Widget einfach und bequem in das eigene Blog einbinden

== Description ==

Das BIC Media Widget ist eine auf der Flash-Technologie basierende Komponente zur einfachen Integration der BIC Media Services in beliebigen Webseiten.
Es k&#246;nnen sowohl B&#252;cher als auch H&#246;rb&#252;cher eingebunden werden. Sollte zu einem gesuchten Begriff ein H&#246;rbuch oder Buch verf&#252;gbar sein, wird dieses automatisch vom Widget angezeigt.
Mehr Information zu BIC Media finden Sie unter [http://www.bic-media.com](http://www.bic-media.com)  

Mit Hilfe des Widgets k&#246;nnen Lese- und H&#246;rproben aus mehreren Tausend B&#252;chern und H&#246;rbuchern in das eigene Blog eingebaut werden.

Mit einem ShortTag wie z.B. `[bic-media isbn="9783442310197"]` wird das Widget in einem Beitrag angezeigt.
Alle n&#246;tigen Javascripts zur Anzeige des Widgets werden vom Plugin automatisch eingebunden.

Im WordPress Editor gibt es nach der Installation des Plugins in der HTML Ansicht einen neuen Button "BIC Media Widget hinzuf&#252;gen". 
Beim Klick auf den Button wird nur noch die ISBN-13 erwartet, die dann &#252;berpr&#252;ft wird.

Noch bequemer ist die Suche nach einem Buch &#252;ber einen neuen "Media Button". Dieser ist allerdings nur sichtbar und nutzbar, wenn im Browser Javascript aktiviert ist.
Oberhalb des Eingabefensters f&#252;gt das Plugin ein neues Buch-Icon "BIC Media Widget hinzuf&#252;gen". Ein Klick darauf &#246;ffnet einen neuen Dialog, in dem komfortabel ein Buch ausgew&#228;hlt und dann in den Editor &#252;bernommen werden kann.

Es gibt zwei verschiedene Widgets:


= Einzel Widget =

Mit dem Einzel-Widget kann nur ein Buch oder H&#246;rbuch dargestellt werden. Der ShortTag daf&#252;r lautet z.B.

`[bic-media isbn="9783442310197" param="showTooltip=no"]` wobei 9783442310197 die gew&#252;nschte ISBN Nummer und showTooltip=no der gew&#252;nschte Parameterstring ist.

Alle m&#246;glichen Konfigurationsparameter werden hier beschrieben: [http://www.bic-media.com/dmr/index.jsp?nav=widget&nav2=config](http://www.bic-media.com/dmr/index.jsp?nav=widget&nav2=config) 


= Karussell Widget =

Ein Widget, mit dem mehrere B&#252;cher oder H&#246;rb&#252;cher gleichzeitig dargestellt werden k&#246;nnen. Dazu kann man entweder eine Liste von ISBN Nummern eingeben oder mit Suchbegriffen eine Auswahl an B&#252;chern zusammenstellen.
&#220;ber Autor, Titel und Verlag k&#246;nnen die Ergebnisse gefiltert werden. Die Darstellung kann &#252;ber Breite, H&#246;he, Hintergrundfarbe, Breite der Buchcover und &#252;ber die maximale Anzahl der dargestellten B&#252;cher individuell angepasst werden.

Der ShortTag f&#252;r dieses Widget lautet z.B.:

`[bic-carousel param="{'width':400, 'height':250, 'publisher':'Heyne Verlag','title':'skorpion','bgcolor':'#B92845', 'size':20, 'coverWidth':125}"]`

wobei der Parameter param die Parameter enth&#228;lt, die per Dialog ermittelt oder per Hand eingegeben werden k&#246;nnen.

Alle m&#246;glichen Konfigurationsparameter werden hier beschrieben: [http://www.bic-media.com/dmr/index.jsp?nav=widget&nav2=carouselConfig](http://www.bic-media.com/dmr/index.jsp?nav=widget&nav2=carouselConfig) 


== Installation ==

Das Plugin inklusive des Verzeichnisses "bic-media" ins Plugin Verzeichnis von WordPress kopieren. Anschlie&#223;end im WordPress Admin Panel unter "Plugins" aktivieren.

== Benutzung ==

* B&#252;cher/H&#246;rb&#252;cher Suchen

In dieser Oberfl&#228;che k&#246;nnen einzelne B&#252;cher oder H&#246;rb&#252;cher gesucht werden. Dazu gibt man eine ISBN-13 Nummer ein oder sucht &#252;ber Title, Autor und Verlag.
Nach der Eingabe ruft man mit der Returntaste oder dem Button Suchen das Ergebnis ab. Im unteren Bereich der Maske wird das Ergebnis tabellarisch dargestellt. B&#252;cher und H&#246;rb&#252;cher werden in getrennten Reitern angezeigt.
Ist das gew&#252;nschte Medium gefunden, klickt man auf "Auswahl" und der ShortTag wird im WordPress Editor erstellt und die Suchmaske geschossen.

* Karussell Widget

&#196;hnlich dem Einzel Widget kann &#252;ber ISBN Nummern oder Suchworte das Widget bef&#252;llt werden. Die ISBN Nummern m&#252;ssen durch Kommas getrennt werden. 
Hat man eine Liste mit ISBN Nummern eingegeben und dr&#252;ckt die RETURN Taste oder klickt auf den Button "Vorschau", wird die ISBN-Liste gefiltert und unbekannte ISBN Nummern werden entfernt.
Die Werte f&#252;r Breite, H&#246;he und Anzahl der Eintr&#228;ge m&#252;ssen Zahlen gr&#246;&#223;er 0 sein. Die Hintergrundfarbe muss in hexadezimalen Farbwerten mit vorangestelltem # angegeben werden. 
Mehr Informationen zu Farben in HTML z.B. [hier](http://www.uni-magdeburg.de/counter/rgb.txt.shtml).


== Frequently Asked Questions ==

= Was sind die Konfigurations-Optionen? =

Die Optionen f&#252;r das Einzel-Widget sind [hier](http://www.bic-media.com/dmr/index.jsp?nav=widget&nav2=config "Konfiguration des Widgets") gelistet.
F&#252;r das Karussell Widget sind die m&#246;glichen Parameter [hier](http://www.bic-media.com/dmr/index.jsp?nav=widget&nav2=carouselConfig "Konfiguration Karussell Widget") gelistet.

Parametern, die nicht &#252;ber die Oberfl&#228;che eingestellt werden k&#246;nnen, kann man einfach &#252;ber den Parameter im ShortTag hinzuf&#252;gen, z.B.

`[bic-media isbn="9783442310197" param="showTooltip=no"]`


= Das Widget zeigt nichts an! Warum? =

Gr&#252;nde k&#246;nnten sein:

* Falsche ISBN Nummer
* Das Buch oder die CD sind (noch) nicht in die Datenbank des Widgets aufgenommen worden

= Das Widget wird in den WordPress Widget Einstellungen nicht angezeigt =

Die BIC Media Widgets sind Flash Bausteine, die nur im Blog angezeigt werden. In der WordPress Admin Oberfl&#228;che und insbesondere in den Widget Einstellungen des Themes tauchen diese Widgets nicht auf.


== Screenshots ==

1. Media Button, der von BIC Media Plugin eingef&#252;gt wird
2. Oberfl&#228;che zur Konfiguration des Einzel-Widgets
3. Oberfl&#228;che zur Konfiguration des Karussell Widgets