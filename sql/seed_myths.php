<?php
// sql/seed_myths.php by Eduardo Bussien
require __DIR__ . '/db.php';

$conn->query("TRUNCATE TABLE myths");

$myths = [
    [
        'slug' => 'primordial-chaos',
        'title' => 'The Primordial Chaos',
        'category' => 'Creation',
        'short' => 'From shapeless Chaos arise Gaia, Tartarus and Eros, the first powers of the cosmos.',
        'full'  => 'In the beginning there is only Chaos, a yawning emptiness. From this formless state emerge Gaia the Earth, Tartarus the abyss, and Eros the force of attraction. Together they lay the foundations for everything that will exist.',
        'characters' => 'Chaos, Gaia, Tartarus, Eros'
    ],
    [
        'slug' => 'birth-of-the-titans',
        'title' => 'The Birth of the Titans',
        'category' => 'Creation',
        'short' => 'Gaia and Uranus give birth to the Titans, the first great rulers of the world.',
        'full'  => 'Gaia joins with Uranus, the sky, and bears the Titans: powerful beings such as Cronus and Rhea. Uranus, fearing his own children, tries to imprison them, but the seeds of rebellion are already growing in the heart of Cronus.',
        'characters' => 'Gaia, Uranus, Cronus, Rhea, Titans'
    ],
    [
        'slug' => 'titanomachy',
        'title' => 'The Titanomachy',
        'category' => 'Quest',
        'short' => 'Zeus leads the Olympians in a ten-year war against the Titans for control of the cosmos.',
        'full'  => 'Cronus reigns by fear after overthrowing Uranus, but his own son Zeus rises against him. With the help of his siblings and the freed Cyclopes and Hundred-Handers, Zeus wages a decade-long war called the Titanomachy. The Titans are defeated and cast into Tartarus, while the Olympians claim the sky.',
        'characters' => 'Zeus, Cronus, Olympian Gods, Titans'
    ],
    [
        'slug' => 'birth-of-athena',
        'title' => 'The Birth of Athena',
        'category' => 'Creation',
        'short' => 'Athena springs fully armed from the head of Zeus after a terrible headache.',
        'full'  => 'After swallowing the wise goddess Metis, Zeus begins to suffer blinding headaches. Hephaestus splits open his skull with an axe to relieve the pressure, and out leaps Athena, fully grown and armed. Her strange birth marks her as a goddess of wisdom, strategy and divine authority.',
        'characters' => 'Zeus, Metis, Athena, Hephaestus'
    ],
    [
        'slug' => 'creation-of-humans',
        'title' => 'The Creation of Humans',
        'category' => 'Creation',
        'short' => 'Prometheus shapes humanity from clay and secretly gifts them the divine spark of fire.',
        'full'  => 'Prometheus molds humans from clay and asks Athena to breathe life into them. Seeing their weakness, he steals fire from the gods and delivers it to humankind, allowing them to cook, forge and build. This act of compassion also sows the seeds of conflict between Zeus and Prometheus.',
        'characters' => 'Prometheus, Athena, Zeus, Humans'
    ],
    [
        'slug' => 'punishment-of-prometheus',
        'title' => 'The Punishment of Prometheus',
        'category' => 'Tragedy',
        'short' => 'For stealing fire for humans, Prometheus is chained to a rock where an eagle tears at his liver.',
        'full'  => 'Zeus takes vengeance on Prometheus for defying his will and helping mortals. The Titan is chained to a remote cliff, and an eagle arrives each day to devour his liver, which grows back every night. Only much later will a hero free him from this endless torment.',
        'characters' => 'Prometheus, Zeus, Eagle, Heracles'
    ],
    [
        'slug' => 'pandoras-box',
        'title' => 'Pandora\'s Box',
        'category' => 'Tragedy',
        'short' => 'Pandora opens a forbidden jar, releasing countless troubles into the world.',
        'full'  => 'To punish humanity, the gods fashion Pandora and send her to earth with a sealed jar. Curiosity overcomes her, and when she opens it, sorrows, plagues and hardships escape to afflict humankind. She slams the lid shut just in time to keep one thing inside: Hope.',
        'characters' => 'Pandora, Zeus, Epimetheus'
    ],
    [
        'slug' => 'labors-of-heracles',
        'title' => 'The Labors of Heracles',
        'category' => 'Quest',
        'short' => 'Heracles must complete twelve impossible labors to atone for a terrible crime.',
        'full'  => 'Driven mad by Hera\'s hatred, Heracles commits a tragic act and seeks purification. The oracle commands him to serve King Eurystheus and complete twelve perilous labors, from slaying the Nemean Lion to capturing Cerberus. Through these trials he becomes the greatest of Greek heroes.',
        'characters' => 'Heracles, Eurystheus, Hera, various monsters'
    ],
    [
        'slug' => 'perseus-and-medusa',
        'title' => 'Perseus and Medusa',
        'category' => 'Quest',
        'short' => 'Perseus journeys to slay the Gorgon Medusa, whose gaze turns mortals to stone.',
        'full'  => 'Sent on a deadly mission by King Polydectes, Perseus seeks the head of Medusa, the only mortal Gorgon. With gifts from the gods and guidance from Athena, he uses a mirrored shield to avoid her petrifying gaze. He severs her head and later uses it as a weapon to protect himself and his mother.',
        'characters' => 'Perseus, Medusa, Athena, Hermes, Polydectes'
    ],
    [
        'slug' => 'theseus-and-the-minotaur',
        'title' => 'Theseus and the Minotaur',
        'category' => 'Quest',
        'short' => 'Theseus descends into the Labyrinth to confront the man-eating Minotaur of Crete.',
        'full'  => 'Athens must send youths to Crete as tribute to the Minotaur, a monster imprisoned in the Labyrinth. Prince Theseus volunteers to end the horror and sails to Knossos. With Ariadne\'s thread to guide him, he navigates the twisting passages, defeats the beast, and leads the survivors back to freedom.',
        'characters' => 'Theseus, Minotaur, Ariadne, King Minos'
    ],
    [
        'slug' => 'jason-and-the-golden-fleece',
        'title' => 'Jason and the Golden Fleece',
        'category' => 'Quest',
        'short' => 'Jason leads the Argonauts on a perilous voyage to retrieve the Golden Fleece.',
        'full'  => 'Jason gathers a band of heroes aboard the Argo and sails to distant Colchis in search of the Golden Fleece. He faces clashing rocks, fire-breathing bulls and dragon-guarded groves. With the help of Medea, he seizes the Fleece, but the price of victory will haunt them both.',
        'characters' => 'Jason, Medea, Argonauts, King Aeetes'
    ],
    [
        'slug' => 'bellerophon-and-the-chimera',
        'title' => 'Bellerophon and the Chimera',
        'category' => 'Quest',
        'short' => 'Bellerophon on Pegasus battles the fire-breathing Chimera.',
        'full'  => 'Falsely accused and sent on a suicide mission, Bellerophon is ordered to slay the Chimera, a monstrous creature of lion, goat and serpent. With Athena\'s aid he tames the winged horse Pegasus and attacks from the sky. He defeats the beast, but later hubris leads him to a bitter fall.',
        'characters' => 'Bellerophon, Pegasus, Chimera, King Iobates'
    ],
    [
        'slug' => 'odysseus-and-the-cyclops',
        'title' => 'Odysseus and the Cyclops',
        'category' => 'Quest',
        'short' => 'Odysseus escapes the cave of the Cyclops Polyphemus through wit and deception.',
        'full'  => 'Storm-tossed Odysseus lands on the island of the Cyclopes and enters the cave of Polyphemus. The giant traps and devours his men, but Odysseus gives him wine and tells him his name is Nobody. After blinding the monster, he and his crew escape beneath the bellies of the Cyclops\' flock.',
        'characters' => 'Odysseus, Polyphemus, Odysseus\' crew'
    ],
    [
        'slug' => 'the-trojan-horse',
        'title' => 'The Trojan Horse',
        'category' => 'Quest',
        'short' => 'The Greeks hide inside a wooden horse to infiltrate and conquer Troy.',
        'full'  => 'After years of stalemate, the Greeks pretend to sail away and leave behind a giant wooden horse as an offering. The Trojans drag it into their city, celebrating what they think is victory. At night the hidden warriors emerge, open the gates, and Troy falls to fire and sword.',
        'characters' => 'Odysseus, Greeks, Trojans, Priam'
    ],
    [
        'slug' => 'orpheus-in-the-underworld',
        'title' => 'Orpheus in the Underworld',
        'category' => 'Tragedy',
        'short' => 'Orpheus descends to Hades to bring back his beloved Eurydice with the power of music.',
        'full'  => 'When Eurydice dies, the musician Orpheus journeys into the Underworld, charming shades and rulers alike with his lyre. Hades agrees to release her on one condition: Orpheus must not look back until they reach the upper world. Doubt overcomes him at the last moment, and Eurydice fades away forever.',
        'characters' => 'Orpheus, Eurydice, Hades, Persephone'
    ],
    [
        'slug' => 'icarus-and-daedalus',
        'title' => 'Icarus and Daedalus',
        'category' => 'Tragedy',
        'short' => 'Daedalus crafts wings of wax and feathers so he and his son Icarus can escape Crete.',
        'full'  => 'Imprisoned by King Minos, Daedalus fashions wings from feathers and wax for himself and his son, warning Icarus not to fly too high or too low. Overcome by joy, Icarus soars toward the sun, melting the wax. He falls into the sea, and Daedalus mourns his loss.',
        'characters' => 'Daedalus, Icarus, King Minos'
    ],
    [
        'slug' => 'oedipus-and-the-sphinx',
        'title' => 'Oedipus and the Sphinx',
        'category' => 'Tragedy',
        'short' => 'Oedipus solves the Sphinx\'s riddle and unknowingly walks toward a darker fate.',
        'full'  => 'On the road to Thebes, Oedipus meets the Sphinx, who devours all who cannot answer her riddle. He solves it, freeing the city and becoming king. Yet the victory hides a grim truth: he has already fulfilled a prophecy of killing his father and marrying his mother.',
        'characters' => 'Oedipus, Sphinx, Jocasta, Laius'
    ],
    [
        'slug' => 'death-of-achilles',
        'title' => 'The Death of Achilles',
        'category' => 'Tragedy',
        'short' => 'The greatest Greek warrior of the Trojan War is struck in his only vulnerable spot.',
        'full'  => 'Achilles dominates the battlefield of Troy, nearly invincible thanks to his divine heritage. Yet he is vulnerable at his heel, the one place not touched by the waters of the Styx. An arrow guided by Apollo strikes that very spot, and the mightiest of the Greeks falls.',
        'characters' => 'Achilles, Paris, Apollo, Greeks'
    ],
    [
        'slug' => 'death-of-hector',
        'title' => 'The Death of Hector',
        'category' => 'Tragedy',
        'short' => 'Achilles slays Hector outside the walls of Troy and drags his body in rage.',
        'full'  => 'After the death of Patroclus, Achilles burns with fury and challenges Hector, Troy\'s greatest defender. They duel before the city walls, and Hector falls. Achilles, unable to master his grief, ties the body to his chariot and drags it, until the pleas of the gods and Priam soften his heart.',
        'characters' => 'Achilles, Hector, Priam, Patroclus'
    ],
    [
        'slug' => 'fall-of-troy',
        'title' => 'The Fall of Troy',
        'category' => 'Tragedy',
        'short' => 'The proud city of Troy burns as the long war finally comes to a brutal end.',
        'full'  => 'Once the Trojan Horse plan succeeds, Greek warriors pour into the sleeping city. Temples are desecrated, palaces looted and the royal family scattered or slain. The fall of Troy marks both the end of a legendary city and the beginning of long wanderings for its survivors.',
        'characters' => 'Trojans, Greeks, Priam, Aeneas'
    ],
    [
        'slug' => 'apollo-and-daphne',
        'title' => 'Apollo and Daphne',
        'category' => 'Tragedy',
        'short' => 'The nymph Daphne flees Apollo and is transformed into a laurel tree to escape him.',
        'full'  => 'Struck by Eros with a piercing arrow of love, Apollo becomes obsessed with the nymph Daphne. She, wounded by an arrow of disdain, wants nothing to do with him and runs until she can run no more. Calling to her father the river god, she is transformed into a laurel tree, which Apollo adopts as his sacred symbol.',
        'characters' => 'Apollo, Daphne, Peneus'
    ],
    [
        'slug' => 'judgment-of-paris',
        'title' => 'The Judgment of Paris',
        'category' => 'Creation',
        'short' => 'Paris must choose the fairest goddess, a decision that will spark the Trojan War.',
        'full'  => 'At a divine wedding, Eris throws a golden apple marked "for the fairest," and Hera, Athena and Aphrodite all claim it. Zeus appoints the Trojan prince Paris to judge. Bribed by Aphrodite with the promise of the most beautiful woman, he chooses her, setting in motion the events that lead to war.',
        'characters' => 'Paris, Hera, Athena, Aphrodite'
    ],
    [
        'slug' => 'abduction-of-persephone',
        'title' => 'The Abduction of Persephone',
        'category' => 'Tragedy',
        'short' => 'Hades seizes Persephone, and Demeter\'s grief brings famine to the earth.',
        'full'  => 'While gathering flowers, Persephone is carried off to the Underworld by Hades. Her mother Demeter searches the earth in despair, neglecting her duties and causing crops to wither. A compromise is reached: Persephone will spend part of the year below and part above, giving rise to the seasons.',
        'characters' => 'Persephone, Hades, Demeter, Zeus'
    ],
    [
        'slug' => 'europa-and-the-bull',
        'title' => 'Europa and Zeus',
        'category' => 'Quest',
        'short' => 'Zeus, in the form of a white bull, carries the princess Europa over the sea.',
        'full'  => 'Zeus falls in love with the Phoenician princess Europa and appears to her as a gentle white bull. When she climbs onto his back, he plunges into the waves and swims to Crete. There he reveals his true form, and Europa becomes the ancestor of Cretan kings and the namesake of a continent.',
        'characters' => 'Zeus, Europa'
    ],
    [
        'slug' => 'birth-of-aphrodite',
        'title' => 'The Birth of Aphrodite',
        'category' => 'Creation',
        'short' => 'From the sea foam arises Aphrodite, goddess of love and beauty.',
        'full'  => 'After Uranus is overthrown and his severed essence falls into the sea, the waters foam and churn. From this sparkling foam a figure takes shape and steps ashore: Aphrodite, radiant goddess of love. Wherever she walks, desire and charm follow.',
        'characters' => 'Aphrodite, Uranus, Gaia'
    ],
];

$stmt = $conn->prepare(
    "INSERT INTO myths (slug, title, category, short_description, full_text, main_characters)
     VALUES (?, ?, ?, ?, ?, ?)"
);

foreach ($myths as $m) {
    $stmt->bind_param(
        'ssssss',
        $m['slug'],
        $m['title'],
        $m['category'],
        $m['short'],
        $m['full'],
        $m['characters']
    );
    $stmt->execute();
}

$stmt->close();
$conn->close();

echo "Inserted " . count($myths) . " myths successfully.";
