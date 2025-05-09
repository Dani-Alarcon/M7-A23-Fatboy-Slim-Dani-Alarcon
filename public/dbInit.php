<?php

$db = new SQLite3('cantants.db');


$db->exec(
    "CREATE TABLE IF NOT EXISTS musics (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nom TEXT NOT NULL,
        biografia TEXT NOT NULL,
        hipervincles TEXT,
        imatges TEXT
    );"
);


$db->exec(
    "INSERT INTO musics (nom, biografia, hipervincles, imatges) VALUES
    ('Ariana Grande',
     'Ariana Grande‑Butera és una cantant, compositora i actriu nord‑americana, coneguda pel seu rang vocal de quatre octaves i pel paper de Cat Valentine a Victorious. Ha guanyat diversos premis Grammy i és reconeguda com un dels icons pop més influents del segle XXI.', 
     'https://es.wikipedia.org/wiki/Ariana_Grande', 
     'https://media.vogue.mx/photos/5e9f0aef8966aa000859aac6/master/pass/como-hacer-el-peinado-de-ariana-grande.jpg'),
    
    ('Bad Bunny',
     'Benito Antonio Martínez Ocasio, conegut artísticament com Bad Bunny, és un raper i cantant de reggaeton i trap llatí originari de Puerto Rico.',
     'https://es.wikipedia.org/wiki/Bad_Bunny',
     'https://upload.wikimedia.org/wikipedia/commons/b/b1/Bad_Bunny_2019_by_Glenn_Francis_(cropped).jpg'),
    
    ('Adele',
     'Adele Laurie Blue Adkins és una cantant i compositora britànica guanyadora de diversos premis, coneguda per el seu àlbum \"21\" i el single \"Hello\".',
     'https://es.wikipedia.org/wiki/Adele',
     'https://upload.wikimedia.org/wikipedia/commons/7/7c/Adele_2016.jpg'),
    
    ('Ed Sheeran',
     'Edward Christopher Sheeran és un cantant, compositor i productor anglès, famós per èxits com \"Shape of You\" i \"Perfect\".',
     'https://es.wikipedia.org/wiki/Ed_Sheeran',
     'https://upload.wikimedia.org/wikipedia/commons/c/c1/Ed_Sheeran-6886_(cropped).jpg'),
    
    ('Rosalía',
     'Rosalía Vila Tobella és una cantant i compositora espanyola que fusiona el flamenc amb la música urbana. Ha guanyat diversos Latin Grammy.',
     'https://es.wikipedia.org/wiki/Rosal%C3%ADa_(cantante)',
     'https://upload.wikimedia.org/wikipedia/commons/4/4e/2023-11-16_Gala_de_los_Latin_Grammy%2C_27_(cropped).jpg'
    );"
);
