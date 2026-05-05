<?php
// add_more_myths.php by Eduardo Bussien
// Run ONCE in your browser: http://localhost/olympus/sql/add_more_myths.php
// Inserts 5 additional myths with full retellings and source citations.
// Idempotent - INSERTs only if the slug is missing.

require __DIR__ . '/db.php';

header('Content-Type: text/html; charset=utf-8');
echo "<pre style='font-family:monospace;font-size:13px;line-height:1.5;'>";

// Make sure the optional `sources` column exists
$colCheck = $conn->query("SHOW COLUMNS FROM myths LIKE 'sources'");
if ($colCheck && $colCheck->num_rows === 0) {
    if ($conn->query("ALTER TABLE myths ADD COLUMN sources TEXT NULL AFTER full_text")) {
        echo "[+] Added column `sources` to `myths`\n";
    } else {
        echo "[!] Failed to add column: " . $conn->error . "\n";
        exit;
    }
}

$newMyths = [
    [
        'slug' => 'eros-and-psyche',
        'title' => 'Eros and Psyche',
        'category' => 'Quest',
        'short' => 'A mortal princess wins back the love of the god Eros after enduring four impossible trials.',
        'full' => "Psyche was the youngest of three princesses, and so beautiful that crowds left the temples of Aphrodite to come and worship her instead. Aphrodite, in jealousy, ordered her son Eros to make Psyche fall in love with the most wretched creature on earth. But when Eros looked upon her he scratched himself with his own arrow and fell in love with her instead. He carried her in secret to a hidden palace, where she lived in luxury and was visited each night by an unseen lover whose voice she came to adore - but who forbade her ever to look at him.\n\nHer envious sisters convinced her that her lover must be a monster, and one night she lit a lamp and gazed upon him as he slept. A drop of hot oil fell on his shoulder. Eros woke, looked at her with sorrow, and flew away. Psyche, desperate to find him, presented herself to Aphrodite and accepted whatever the goddess would set her. She was given four impossible tasks: to sort an enormous heap of mixed grain by morning (ants helped her); to gather the golden fleece of the murderous sun-rams (a reed advised her to wait until the heat sent them to sleep); to fill a flask from the source of the Styx, guarded by dragons (an eagle of Zeus carried it for her); and finally to descend into the underworld and bring back a box of Persephone's beauty without opening it.\n\nShe fulfilled even the last. But on the way back, overcome by curiosity and a desire to be more beautiful for her lost love, she opened the box. What rose from it was not beauty but the sleep of the dead, and she fell down upon the road as if dead herself. Eros, his wound now healed, found her there, gathered the sleep back into the box, and woke her with a kiss. He carried her up to Olympus, where Zeus made her immortal, and Aphrodite at last consented to the marriage. Their daughter was named Voluptas (Pleasure). The story, told most fully by Apuleius in the second century CE, is the great Greek-Latin allegory of the soul (psyche) seeking love (eros) and finding it only after long suffering.",
        'characters' => 'Psyche, Eros, Aphrodite, Zeus, Persephone',
        'sources' => "Apuleius, The Golden Ass 4.28-6.24 (the canonical telling)\nFulgentius, Mythologiae 3.6 (allegorical reading)\nGreek vase paintings from the 4th century BCE attest the myth before Apuleius",
    ],
    [
        'slug' => 'echo-and-narcissus',
        'title' => 'Echo and Narcissus',
        'category' => 'Tragedy',
        'short' => 'A nymph cursed to repeat the words of others falls hopelessly in love with a youth who can love only himself.',
        'full' => "The nymph Echo was a chatterer of the woods who had long served Hera by distracting her with endless conversation while Zeus dallied with other nymphs. When Hera discovered the trick, she punished Echo with a cruel curse: from that day on, Echo could never speak first, but only repeat the last words said to her by another. Her own voice was taken from her, and with it, in time, her body - until only her voice remained, drifting through caves and hillsides.\n\nNarcissus was the son of the river god Cephissus and the nymph Liriope. He was so beautiful that every nymph and youth who saw him fell in love, but he scorned them all. The seer Tiresias, when asked whether the boy would live a long life, gave the riddle: 'If he never knows himself.' One day, while hunting in the forest, Echo saw him, and her heart was lost. She followed him at a distance, longing to call out, but able only to repeat his words. When Narcissus, separated from his companions, called 'Is anyone there?' she could only answer 'There!' He cried 'Come!' and she answered 'Come!' She ran to embrace him; he flung her off with disgust. She wasted away in grief, until only her voice was left to wander the hills.\n\nA young man whom Narcissus had also rejected - Ameinias in some accounts - prayed for retribution before killing himself, and Nemesis heard the prayer. As Narcissus stooped to drink at a clear pool, he saw his own reflection and fell instantly in love with it. He could not eat, could not sleep, could not bear to leave the pool. Slowly, watching the figure he could never embrace, he wasted away in turn. Where his body had lain there grew a flower with white petals around a yellow heart - the narcissus, which still nods over still water and still bears his name.",
        'characters' => 'Echo, Narcissus, Hera, Tiresias, Nemesis',
        'sources' => "Ovid, Metamorphoses 3.339-510 (the canonical telling)\nPausanias, Description of Greece 9.31 (alternative version)\nConon, Narrations 24\nLonginus, On the Sublime 13",
    ],
    [
        'slug' => 'arachne-and-athena',
        'title' => 'Arachne and Athena',
        'category' => 'Tragedy',
        'short' => 'A mortal weaver challenges Athena to a contest and is transformed into the first spider.',
        'full' => "Arachne was a young woman of Lydia, daughter of Idmon the dyer of Colophon, whose skill at weaving was the marvel of all who saw it. The nymphs of the rivers and the woods would leave their springs to come and watch her work. So great was her gift, and so great her pride in it, that she boasted she could weave better than even Athena, the patron goddess of the loom - and refused to give the goddess any credit for her talent.\n\nAthena, hearing the boast, came to her in the form of an old woman and warned her gently to acknowledge the goddess and beg forgiveness. Arachne mocked the old woman and repeated the challenge. The goddess threw off her disguise and stood revealed in her divinity. The two set up their looms and began to weave.\n\nAthena wove a tapestry of perfect formal beauty: in the centre, the contest between herself and Poseidon for the patronage of Athens; in each of the four corners, a scene of mortals who had presumed against the gods and been transformed into rocks or birds - a clear warning to her opponent. Arachne wove a tapestry no less perfect technically, but its subject was a catalogue of the gods' crimes against mortals: Zeus seducing Europa as a bull, Leda as a swan, Antiope as a satyr; Poseidon ravishing women in many forms; Apollo deceiving Isse; the long, ugly history of divine abuse. The work was flawless, and the truth of it was undeniable. Athena, unable to fault the weaving, struck Arachne with her shuttle. The girl, in shame and despair, hanged herself with her own thread. Athena, perhaps in pity or perhaps in further punishment, sprinkled her with the juice of Hecate's herb. Arachne's hair fell out; her nose and ears shrank; her body shrivelled to a small dark form; her fingers became spindly legs along her sides. She would weave forever, hanging from her own thread - the first spider, and the ancestor of all that bear her Greek name (arachne) to this day.",
        'characters' => 'Arachne, Athena, Hecate',
        'sources' => "Ovid, Metamorphoses 6.1-145 (the canonical telling)\nVirgil, Georgics 4.246-247 (the spider as Minerva's enemy)\nApuleius, Florida 9 (later reflection)",
    ],
    [
        'slug' => 'phaethon-and-the-sun',
        'title' => 'Phaethon and the Sun Chariot',
        'category' => 'Tragedy',
        'short' => 'The mortal son of Helios takes the reins of the sun chariot for a single day and nearly burns the world.',
        'full' => "Phaethon was the mortal son of Helios, the Sun, and the Oceanid nymph Clymene. He was raised on earth without his father, and his playmates mocked him as a boaster when he claimed divine parentage. Stung by their disbelief, he travelled to the great palace of the Sun in the east, blazing with gold and chrysolite, and demanded that his father acknowledge him before all the gods. Helios embraced him at once and, to prove his love, swore by the river Styx - the most binding of all oaths - to grant him whatever he asked.\n\nPhaethon asked to drive the sun chariot for a single day. Helios begged him to ask for anything else. He warned him that the path crossed the highest heaven, where even the king of the gods feared to ride; that the four fire-breathing horses obeyed only him; that the way passed between the Crab, the Lion, the Scorpion, and the Bull, and that a mortal hand could not hold it. But the boy was set, and the oath could not be unsworn.\n\nAt dawn the horses, feeling a lighter rein, broke from the path. The chariot soared too high, and the earth froze; it plunged too low, and the rivers boiled, the forests caught fire, the seas withdrew, and Libya was scorched into desert (which is why, the Greeks said, that land remains so to this day). The Ethiopians' skin was darkened by the heat. The mountains burned. Gaia herself cried out to Zeus to spare her, and Zeus, having no other choice, hurled a thunderbolt that struck Phaethon dead. The boy fell flaming through the sky and landed in the river Eridanus. His sisters, the Heliades, came to the bank and wept for him until they were transformed into poplar trees, and their tears, falling into the water, hardened into amber.",
        'characters' => 'Phaethon, Helios, Clymene, Zeus, the Heliades',
        'sources' => "Ovid, Metamorphoses 1.747-2.400 (the canonical telling)\nEuripides, Phaethon (fragments)\nLucretius, De Rerum Natura 5.396-405\nPlato, Timaeus 22c-d (the rationalising tradition)\nHyginus, Fabulae 152-154",
    ],
    [
        'slug' => 'midas-golden-touch',
        'title' => "Midas and the Golden Touch",
        'category' => 'Tragedy',
        'short' => "King Midas asks that everything he touches turn to gold, and discovers too late what such a gift means.",
        'full' => "Midas was king of Phrygia, son of the gardener-king Gordius and of Cybele the Mother of the Gods. The wandering god Dionysus, returning from his triumphant tour of India, came one day through Phrygia, and his old companion Silenus - the bald, drunken, fat-bellied tutor of Dionysus - wandered off and fell asleep in Midas's rose garden. Country people brought the old satyr to the king, who recognised him at once, treated him to ten days of feasting, and brought him personally back to Dionysus.\n\nGrateful for the kindness, Dionysus offered Midas any gift he chose. Midas, dazzled by the thought of inexhaustible riches, asked that everything he touched should turn to gold. Dionysus warned him to think again. Midas insisted. The god granted the wish.\n\nAt first the king was delighted. He touched an oak twig and it became gold. He pulled a stone from the ground and it became gold. He touched the pillars of his palace and they became gold. Then dinner was set. He picked up bread, and it became gold; he raised wine to his lips, and it became gold in his mouth; he reached for fruit, and it became gold; he touched his beloved daughter (in the most famous later version of the story), and she stiffened into a golden statue in his arms. Famished, terrified, broken, he ran back to Dionysus and begged the god to take the gift away. Dionysus told him to bathe in the river Pactolus near Sardis, and the curse would pass into the water. Midas obeyed. The Pactolus has carried gold-bearing sand ever since, and the king lived more humbly thereafter - though, in a later episode, he found himself given the ears of an ass for offending Apollo, which he had to hide forever beneath a tall Phrygian cap.",
        'characters' => 'Midas, Dionysus, Silenus, Apollo',
        'sources' => "Ovid, Metamorphoses 11.85-193 (the canonical telling)\nHyginus, Fabulae 191\nAristotle, Politics 1.9 (cited as a moral example)\nHerodotus, Histories 1.14, 8.138 (the historical Midas)",
    ],
];

$ok = 0; $skipped = 0; $failed = 0;

foreach ($newMyths as $m) {
    // Check if it already exists
    $stmt = $conn->prepare("SELECT id FROM myths WHERE slug = ? LIMIT 1");
    $stmt->bind_param('s', $m['slug']);
    $stmt->execute();
    $exists = $stmt->get_result()->num_rows > 0;
    $stmt->close();

    if ($exists) {
        echo "[=] " . $m['slug'] . " already exists - skipping\n";
        $skipped++;
        continue;
    }

    $stmt = $conn->prepare(
        "INSERT INTO myths (slug, title, category, short_description, full_text, main_characters, sources)
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );
    if (!$stmt) {
        echo "[!] Prepare failed for " . $m['slug'] . ": " . $conn->error . "\n";
        $failed++;
        continue;
    }
    $stmt->bind_param('sssssss',
        $m['slug'], $m['title'], $m['category'], $m['short'],
        $m['full'], $m['characters'], $m['sources']
    );
    if ($stmt->execute()) {
        echo "[+] Inserted " . $m['slug'] . "\n";
        $ok++;
    } else {
        echo "[!] Insert failed for " . $m['slug'] . ": " . $stmt->error . "\n";
        $failed++;
    }
    $stmt->close();
}

$conn->close();

echo "\n----------------------------------------\n";
echo "Done. " . count($newMyths) . " myths processed.\n";
echo "  Inserted: $ok\n";
echo "  Skipped:  $skipped\n";
echo "  Failed:   $failed\n";
echo "</pre>";
