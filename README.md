INFORMAZIONI

Questa Applicazione è stata creata utilizzando il framework LARAVEL.
Tecnologie utilizzate:
PHP v.8
JS
HTML
CSS
LARAVEL MIX (Web-Pack)
NPM
COMPOSER


UTILIZZO

Web app per fare l'upload di un file csv, leggerlo e inizializzare i dati in un database (di default MySql) per poi creare dei file csv per il download, una API endpoint e una view html con le tabelle. Si creano perciò tre tabelle, una coi dati corretti, una con i dati revisionati e una con i dati scorretti. I dati sono stati valutati in base al numero di telefono del Sudafrica, in cui compaiono 11 cifre e il prefisso è il 27. Nel controller principale PhoneController ci sono dei parametri personalizzabili: il numero delle righe iniziali da scartare (per eventuale titolo) del file e il numero delle righe che si vogliono tenere per file, in base alla grandezza del file da gestire. Per lavori particolarmente grandi si consiglia di incrementare l'applicazione con Redis in modo da poter svolgere temporalmente le azioni sul database. Ho cercato di usare i Components e i Blade per una maggiore scalabilità del Progetto. Non è ancora stata implementata la vista Mobile e i media query del CSS. 


CONFIGURAZIONE

Copiare il file .env.example, salvarlo come .env e editarlo per le configuazioni dell'app e del server locale. 
