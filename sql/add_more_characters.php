<?php
// add_more_characters.php by Eduardo Bussien
// Run ONCE in your browser: http://localhost/olympus/sql/add_more_characters.php
// Inserts 3 additional heroes (Theseus, Jason, Orpheus) with full biographies
// and ancient source citations. Idempotent - INSERTs only if the slug is missing.

require __DIR__ . '/db.php';

header('Content-Type: text/html; charset=utf-8');
echo "<pre style='font-family:monospace;font-size:13px;line-height:1.5;'>";

// Make sure the optional `sources` column exists (added by upgrade_bios.php)
$colCheck = $conn->query("SHOW COLUMNS FROM characters LIKE 'sources'");
if ($colCheck && $colCheck->num_rows === 0) {
    if ($conn->query("ALTER TABLE characters ADD COLUMN sources TEXT NULL AFTER full_bio")) {
        echo "[+] Added column `sources` to `characters`\n";
    } else {
        echo "[!] Failed to add column: " . $conn->error . "\n";
        exit;
    }
}

$newCharacters = [
    [
        'slug' => 'theseus',
        'name' => 'Theseus',
        'type' => 'Hero',
        'domain' => 'Athenian kingship, monster-slaying, civic founding',
        'symbol' => 'Club, sword, labrys, sandals',
        'short' => 'Athenian prince who slew the Minotaur and unified Attica into a single state.',
        'bio' => "Theseus is the great national hero of Athens, the Greek answer to the Dorian Heracles. He was the son of King Aegeus of Athens and Princess Aethra of Troezen - and, in a dual paternity tradition that the Athenians prized, also of the god Poseidon, who lay with Aethra on the same night. Aegeus, returning to Athens, hid a sword and a pair of sandals beneath a great rock, and told Aethra that when their son was strong enough to lift the stone he should follow them to the city.\n\nAt sixteen Theseus rolled the rock aside, took up the tokens, and set out for Athens - choosing the dangerous overland route rather than the safe sea voyage so that he might prove himself. Along the way he killed six famous bandits and monsters who had terrorised the road, including the club-wielding Periphetes (whose weapon he kept), the pine-bender Sinis, the Crommyonian Sow, the cliff-rolling Sciron, the wrestler Cercyon, and the cruel innkeeper Procrustes, who fitted his guests to a bed by stretching or amputating them. Theseus dispatched each by the same method they had used on their victims.\n\nIn Athens his stepmother Medea tried to poison him, but Aegeus recognised the sword and embraced him as his heir. His most famous adventure followed: the voyage to Crete to slay the Minotaur in the Labyrinth, made possible by Ariadne's thread. Returning to Athens (after abandoning Ariadne on Naxos), he forgot to change his ship's black sails to white, and Aegeus, watching from the cliff, hurled himself into the sea that bears his name. As king of Athens, Theseus was credited with the synoikismos - the unification of the scattered villages of Attica into a single city-state, the foundational political act of classical Athens. He fought the Amazons, took part in the Calydonian Boar hunt, descended to the underworld with his friend Pirithous, and returned by the rescue of Heracles.",
        'sources' => "Plutarch, Theseus 1-35 (the fullest narrative)\nApollodorus, Bibliotheca 3.16; Epitome 1.1-1.24\nBacchylides, Ode 17, 18\nPausanias, Description of Greece 1.17, 2.31\nDiodorus Siculus 4.59-4.63\nEuripides, Hippolytus, Suppliants",
    ],
    [
        'slug' => 'jason',
        'name' => 'Jason',
        'type' => 'Hero',
        'domain' => 'Voyaging, leadership of the Argonauts, kingship denied',
        'symbol' => 'The Argo, the Golden Fleece, single sandal',
        'short' => 'Captain of the Argonauts who sailed to the ends of the world for the Golden Fleece.',
        'bio' => "Jason is the leader of the Argonauts and the rightful heir to the kingdom of Iolcus in Thessaly. His uncle Pelias, having usurped the throne from Jason's father Aeson, had been warned by an oracle to beware a stranger wearing only one sandal. When Jason came of age, raised in secret by the centaur Chiron, he returned to claim his inheritance. Crossing the river Anaurus, he carried an old woman across - Hera in disguise - losing one sandal in the mud, and arrived at the palace of Pelias single-shod and unrecognised. Pelias, knowing him at once for the foretold danger, devised a quest he was sure would kill him: to bring back the Golden Fleece from distant Colchis on the eastern shore of the Black Sea.\n\nJason summoned the heroes of his generation to share the venture. The roster of the Argo was the closest thing the Greeks had to a national assembly of heroes: Heracles, Orpheus, Castor and Polydeuces, the seer Mopsus, the swift Atalanta, Peleus, Telamon, Idas, Lynceus, and many more. They built the great ship Argo and sailed east. They survived the Symplegades (the clashing rocks at the mouth of the Black Sea), the harpies who tormented the blind seer Phineus, the Lemnian women, the giants of Cyzicus, and the Stymphalian birds.\n\nIn Colchis, King Aeetes set Jason impossible tasks: to yoke fire-breathing bulls, plough a field, and sow it with dragon's teeth that sprouted into earth-born warriors. The king's daughter, the sorceress Medea, fell in love with Jason and gave him an ointment that protected him from fire; she also drugged the dragon that guarded the Fleece. They fled with the Fleece. Their return voyage took them through every corner of the known world. But the love between Jason and Medea, which had bought him every victory, would later destroy them both - culminating in the murders dramatized in Euripides's Medea. Jason died alone, an old man, struck on the head by a falling beam from the rotting hulk of the Argo.",
        'sources' => "Apollonius of Rhodes, Argonautica (full epic)\nPindar, Pythian 4 (the canonical lyric account)\nApollodorus, Bibliotheca 1.9.16-1.9.27\nEuripides, Medea\nHyginus, Fabulae 12-23\nHesiod, Theogony 992-1002",
    ],
    [
        'slug' => 'orpheus',
        'name' => 'Orpheus',
        'type' => 'Hero',
        'domain' => 'Music, poetry, mystery religion, descent into Hades',
        'symbol' => 'Lyre, laurel crown, severed singing head',
        'short' => 'The greatest mortal musician, who descended into Hades to win back his beloved Eurydice.',
        'bio' => "Orpheus was the son of the Muse Calliope and (in most accounts) the Thracian king Oeagrus, though some traditions name Apollo as his father. From either parent he inherited a power that no other mortal possessed: when he played the lyre and sang, the wild beasts of the forest came to listen, the trees uprooted themselves to crowd around him, the rivers paused in their courses, and the very stones of the mountains shifted to be nearer the sound. Apollo himself was said to have given him his first lyre.\n\nHe sailed with the Argonauts and made the voyage possible at several critical moments - drowning out the song of the Sirens with his own, soothing the quarrels among the heroes, calling down sleep upon dragon-guards. But the central story of his life is the loss and recovery of his bride Eurydice. On their wedding day she was bitten by a serpent and died. Orpheus did what no living mortal had done: he descended through the gates of Hades, charmed Cerberus to sleep with his music, and stood before the rulers of the dead. His song moved them to tears. They agreed to release Eurydice on a single condition - that Orpheus must not look back at her until both had emerged into the sunlight. At the very threshold of the upper world, unable to bear the silence, he turned. She was drawn back into the dark forever.\n\nHe wandered grief-stricken through Thrace, refusing the company of women, and was at last torn apart by a band of frenzied Maenads (the followers of Dionysus) who resented his rejection. His severed head, still singing, floated down the river Hebrus to the sea and was washed up on Lesbos, where it became an oracle. The Muses gathered his limbs and buried them at the foot of Olympus. Beyond myth, Orpheus was also the legendary founder of the Orphic Mysteries - a body of religious poetry and ritual that taught the immortality of the soul and the cycle of rebirth, deeply influencing Pythagoras and Plato.",
        'sources' => "Virgil, Georgics 4.453-527\nOvid, Metamorphoses 10.1-105; 11.1-66\nApollodorus, Bibliotheca 1.3.2; 1.9.16, 25\nPlato, Symposium 179d; Phaedrus 244d-245a\nPindar, Pythian 4.176-177\nPausanias, Description of Greece 9.30",
    ],
];

$ok = 0; $skipped = 0; $failed = 0;

foreach ($newCharacters as $c) {
    // Check if it already exists
    $stmt = $conn->prepare("SELECT id FROM characters WHERE slug = ? LIMIT 1");
    $stmt->bind_param('s', $c['slug']);
    $stmt->execute();
    $exists = $stmt->get_result()->num_rows > 0;
    $stmt->close();

    if ($exists) {
        echo "[=] " . $c['slug'] . " already exists - skipping\n";
        $skipped++;
        continue;
    }

    $stmt = $conn->prepare(
        "INSERT INTO characters (slug, name, type, domain, symbol, short_description, full_bio, sources)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );
    if (!$stmt) {
        echo "[!] Prepare failed for " . $c['slug'] . ": " . $conn->error . "\n";
        $failed++;
        continue;
    }
    $stmt->bind_param('ssssssss',
        $c['slug'], $c['name'], $c['type'], $c['domain'],
        $c['symbol'], $c['short'], $c['bio'], $c['sources']
    );
    if ($stmt->execute()) {
        echo "[+] Inserted " . $c['slug'] . "\n";
        $ok++;
    } else {
        echo "[!] Insert failed for " . $c['slug'] . ": " . $stmt->error . "\n";
        $failed++;
    }
    $stmt->close();
}

$conn->close();

echo "\n----------------------------------------\n";
echo "Done. " . count($newCharacters) . " characters processed.\n";
echo "  Inserted: $ok\n";
echo "  Skipped:  $skipped\n";
echo "  Failed:   $failed\n";
echo "</pre>";
