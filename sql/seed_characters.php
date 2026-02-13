<?php
// seed_characters.php by Eduardo Bussien
// Run once: http://localhost/olympus/sql/seed_characters.php

require __DIR__ . '/db.php';

$characters = [
    // ===== OLYMPIAN GODS / GODDESSES =====
    [
        'slug' => 'zeus',
        'name' => 'Zeus',
        'type' => 'Olympian God',
        'domain' => 'Sky, thunder, kingship',
        'symbol' => 'Thunderbolt, eagle, oak',
        'short_description' => 'King of the gods and ruler of the sky, wielder of the thunderbolt.',
        'full_bio' => "Zeus is the chief deity of the Greek pantheon and ruler of Mount Olympus.
He is the son of the Titans Cronus and Rhea and the brother of Hera, Poseidon, Hades, Demeter, and Hestia.
After overthrowing his father and freeing his siblings, Zeus divided the cosmos with his brothers: the sky
for himself, the sea for Poseidon, and the underworld for Hades.

As god of the sky and storms, Zeus commands thunder, lightning, and rain. He is often depicted holding a
thunderbolt and accompanied by an eagle. Although he protects justice, hospitality, and oaths, Zeus is also
famous for his many love affairs with goddesses and mortals, which drive the plots of countless myths."
    ],
    [
        'slug' => 'hera',
        'name' => 'Hera',
        'type' => 'Olympian Goddess',
        'domain' => 'Marriage, queenship, family',
        'symbol' => 'Peacock, crown, scepter',
        'short_description' => 'Queen of the gods and guardian of marriage and family.',
        'full_bio' => "Hera is the wife and sister of Zeus and queen of the Olympian gods.
She presides over marriage, legitimate birth, and the protection of households. Her sacred animals include
the cow and the peacock, whose feathers are said to bear the hundred eyes of the giant Argus.

In myth Hera appears both majestic and fierce. She fiercely defends the sanctity of marriage and often
punishes Zeus's lovers and illegitimate children, including Heracles and Io. At the same time, she can be a
protector of cities and a patron of women, embodying both the dignity and tension of divine queenship."
    ],
    [
        'slug' => 'poseidon',
        'name' => 'Poseidon',
        'type' => 'Olympian God',
        'domain' => 'Sea, earthquakes, horses',
        'symbol' => 'Trident, horse, dolphin',
        'short_description' => 'God of the sea and earthquakes, brother of Zeus and Hades.',
        'full_bio' => "Poseidon rules the seas and all waters, carrying a great trident that can stir storms,
shatter rocks, and shake the earth itself-hence his title Earth-Shaker. Sailors prayed to him for calm
seas, while cities sought his favor for safe harbors and maritime power.

He is closely associated with horses and chariots and is sometimes credited with creating the first horse.
Poseidon appears throughout Greek myth, from his contest with Athena over Athens to his vendetta against
Odysseus in the Odyssey."
    ],
    [
        'slug' => 'hades',
        'name' => 'Hades',
        'type' => 'Olympian God',
        'domain' => 'Underworld, the dead, hidden wealth',
        'symbol' => 'Bident, helm of darkness, Cerberus',
        'short_description' => 'Lord of the underworld and ruler of the realm of the dead.',
        'full_bio' => "Hades presides over the realm of the dead, a shadowy kingdom beneath the earth.
He is stern rather than evil, ensuring that the dead remain in his domain. His helm of darkness renders
its wearer invisible, and the three-headed dog Cerberus guards the gates of the underworld.

The best-known myth of Hades is his abduction of Persephone, daughter of Demeter, to be his queen.
Their compromise-Persephone spending part of the year below and part above-explains the cycle of the seasons."
    ],
    [
        'slug' => 'demeter',
        'name' => 'Demeter',
        'type' => 'Olympian Goddess',
        'domain' => 'Agriculture, grain, fertility',
        'symbol' => 'Sheaf of wheat, torch, cornucopia',
        'short_description' => 'Goddess of agriculture and the life-giving grain.',
        'full_bio' => "Demeter is the goddess of grain, agriculture, and the fertility of the earth.
Farmers honor her as the source of a successful harvest, and many festivals celebrate her gifts of bread
and sustenance.

Her most famous myth centers on the abduction of her daughter Persephone by Hades. Grief-stricken,
Demeter lets the earth grow barren until a compromise is reached. Persephone spends part of the year in
the underworld (winter) and part with her mother (spring and summer), linking Demeter directly to the
cycle of growth and dormancy."
    ],
    [
        'slug' => 'hestia',
        'name' => 'Hestia',
        'type' => 'Olympian Goddess',
        'domain' => 'Hearth, home, sacred fire',
        'symbol' => 'Hearth fire, modest veil',
        'short_description' => 'Gentle goddess of the hearth and the sacred household flame.',
        'full_bio' => "Hestia is the quiet but essential goddess of the hearth and domestic fire.
Every home and city maintained a sacred flame in her honor, symbolizing unity, warmth, and stability.

Unlike many Olympians, Hestia avoids conflict and intrigue. She rejects marriage proposals from Poseidon
and Apollo, choosing instead a life of chastity and service. Her presence represents peace in the household
and the continuity of family life."
    ],
    [
        'slug' => 'apollo',
        'name' => 'Apollo',
        'type' => 'Olympian God',
        'domain' => 'Sun, music, prophecy, healing',
        'symbol' => 'Lyre, laurel wreath, bow, sun',
        'short_description' => 'God of light, music, prophecy, and healing, twin brother of Artemis.',
        'full_bio' => "Apollo is a many-sided god associated with the sun, music, archery, prophecy, and healing.
From his sanctuary at Delphi, his oracle speaks in riddles that guide kings and heroes alike. He is often
depicted with a golden lyre or a bow and arrows.

Apollo inspires poets and musicians, brings plagues with his arrows, and lifts them through medicine and
purification. His myths include the slaying of the Python, his tragic love for Daphne, and his guidance of
heroes during the Trojan War."
    ],
    [
        'slug' => 'artemis',
        'name' => 'Artemis',
        'type' => 'Olympian Goddess',
        'domain' => 'Hunt, wilderness, moon, maidens',
        'symbol' => 'Bow, deer, crescent moon',
        'short_description' => 'Virgin goddess of the hunt, wild places, and young women.',
        'full_bio' => "Artemis is the twin sister of Apollo and guardian of wild animals, forests, and the hunt.
She roams the wilderness with her nymph companions, carrying a silver bow. As a virgin goddess she also
protects maidens and presides over transitions such as childbirth.

Artemis can be both a gentle protector of animals and a fierce avenger of disrespect. She punishes
Actaeon for seeing her bathing, demands sacrifice from Agamemnon, and helps Odysseus’s mother in mythic
retellings of his story."
    ],
    [
        'slug' => 'athena',
        'name' => 'Athena',
        'type' => 'Olympian Goddess',
        'domain' => 'Wisdom, strategy, warfare, crafts',
        'symbol' => 'Owl, olive tree, helmet, spear',
        'short_description' => 'Goddess of wisdom and strategic warfare, patron of Athens.',
        'full_bio' => "Athena is born fully armored from the head of Zeus after he swallows her mother Metis.
She embodies clear thinking, strategy, and just warfare, as well as crafts such as weaving and metalwork.

As patron goddess of Athens, she wins the city by gifting the olive tree, symbol of peace and prosperity.
She acts as advisor and protector to many heroes, including Odysseus, Perseus, and Heracles, guiding them
with reason rather than brute force."
    ],
    [
        'slug' => 'ares',
        'name' => 'Ares',
        'type' => 'Olympian God',
        'domain' => 'War, bloodshed, battle frenzy',
        'symbol' => 'Spear, helmet, vulture, dog',
        'short_description' => 'God of violent war and the chaos of battle.',
        'full_bio' => "Ares personifies the brutal, chaotic side of war-bloodshed, rage, and destruction.
Unlike Athena's strategic warfare, Ares delights in the clash of weapons and the cries of battle.

Feared even by other gods, he appears in myths as both cowardly and terrifying, wounded in the Iliad yet
capable of spreading fear across the battlefield. Despite his reputation, he fathers several notable
children, including the Amazons and the love-god Eros (in some traditions)."
    ],
    [
        'slug' => 'hermes',
        'name' => 'Hermes',
        'type' => 'Olympian God',
        'domain' => 'Travel, messages, trade, trickery',
        'symbol' => 'Winged sandals, caduceus, travelers hat',
        'short_description' => 'Messenger of the gods, guide of souls, and patron of travelers and thieves.',
        'full_bio' => "Hermes is a quick-witted god of boundaries, communication, and movement.
He wears winged sandals and carries the caduceus, acting as divine messenger and escort of souls to the
underworld (psychopomp).

From infancy he is cunning, famously stealing Apollo's cattle and inventing the lyre in the same day.
Hermes protects travelers, merchants, and even thieves, representing the fluid, in-between spaces of roads,
markets, and negotiations."
    ],
    [
        'slug' => 'aphrodite',
        'name' => 'Aphrodite',
        'type' => 'Olympian Goddess',
        'domain' => 'Love, beauty, desire',
        'symbol' => 'Dove, rose, seashell, girdle',
        'short_description' => 'Goddess of love and beauty who stirs desire among gods and mortals.',
        'full_bio' => "Aphrodite arises from sea foam near Cyprus (in one tradition) and embodies love,
beauty, and irresistible desire. Wherever she walks, flowers bloom, and hearts are stirred.

Though often gentle and enchanting, Aphrodite's power can be dangerous. Her influence helps start the
Trojan War when she grants Paris the love of Helen. She is married to Hephaestus but loves Ares and has
many children, including Eros and Aeneas."
    ],
    [
        'slug' => 'dionysus',
        'name' => 'Dionysus',
        'type' => 'Olympian God',
        'domain' => 'Wine, ecstasy, theater, transformation',
        'symbol' => 'Ivy wreath, thyrsus, vine, leopard',
        'short_description' => 'God of wine, ecstatic ritual, and the shifting boundary between order and chaos.',
        'full_bio' => "Dionysus is the god of wine, ecstatic celebration, and the dissolving of boundaries.
His followers, including maenads and satyrs, roam in frenzied rites that threaten ordinary social order but
also bring release and renewal.

He is a late addition to Olympus and often an outsider, traveling the world to spread his cult.
Dionysus is closely linked to theater, masks, and transformation, making him a symbol of both madness and
creative inspiration."
    ],
    [
        'slug' => 'hephaestus',
        'name' => 'Hephaestus',
        'type' => 'Olympian God',
        'domain' => 'Fire, metalwork, craftsmanship',
        'symbol' => 'Hammer, anvil, forge, tongs',
        'short_description' => 'Lame god of the forge, master craftsman of the gods.',
        'full_bio' => "Hephaestus is the divine blacksmith, crafting weapons, armor, and wondrous devices for
the gods. Unlike most Olympians he is physically imperfect, often depicted as lame, yet his skill is unmatched.

Thrown from Olympus as a child in some myths, Hephaestus returns to build palaces, thrones, and mechanical
wonders. He forges Zeus' thunderbolts, Achilles' armor, and intricate golden automatons that serve in his
workshop."
    ],
    [
        'slug' => 'persephone',
        'name' => 'Persephone',
        'type' => 'Underworld Goddess',
        'domain' => 'Spring, queen of the underworld',
        'symbol' => 'Pomegranate, torch, flowers',
        'short_description' => 'Daughter of Demeter and queen of the underworld alongside Hades.',
        'full_bio' => "Persephone is the daughter of Demeter and Zeus and becomes queen of the underworld after
being abducted by Hades. Tricked into eating pomegranate seeds, she is bound to spend part of each year in
his realm.

Her dual role links life and death: as maiden of spring she brings growth and blossoms; as queen below she
rules among the dead. The rhythm of her descent and return underlies the ancient explanation for the
changing seasons."
    ],

    // ===== TITANS & TITANESSES =====
    [
        'slug' => 'cronus',
        'name' => 'Cronus',
        'type' => 'Titan',
        'domain' => 'Time, harvest, former ruler of the cosmos',
        'symbol' => 'Sickle, hourglass',
        'short_description' => 'Leader of the Titans who overthrows Uranus and is later overthrown by Zeus.',
        'full_bio' => "Cronus is the youngest of the Titans, son of Uranus (Sky) and Gaia (Earth).
Urged on by his mother, he uses a sickle to overthrow his tyrannical father and becomes ruler of the
cosmos during the so-called Golden Age.

Fearing a prophecy that one of his children will depose him, Cronus swallows each newborn-Hestia, Demeter,
Hera, Hades, and Poseidon-until Rhea hides Zeus. Zeus later forces Cronus to vomit up his siblings and
leads them in the Titanomachy, a war that ends Titan rule."
    ],
    [
        'slug' => 'rhea',
        'name' => 'Rhea',
        'type' => 'Titaness',
        'domain' => 'Motherhood, generation of gods',
        'symbol' => 'Lion-drawn chariot, drum',
        'short_description' => 'Mother of the Olympians who saves Zeus from being swallowed by Cronus.',
        'full_bio' => "Rhea is a daughter of Uranus and Gaia and sister-wife of Cronus.
She bears many of the Olympian gods-Hestia, Demeter, Hera, Hades, Poseidon, and Zeus-and is often called
“Mother of the Gods.”

Horrified that Cronus devours each newborn, Rhea devises a plan to save her youngest, Zeus.
She hides the infant in a cave on Crete and gives Cronus a stone wrapped in swaddling clothes instead.
This act makes the eventual rise of the Olympians possible."
    ],
    [
        'slug' => 'atlas',
        'name' => 'Atlas',
        'type' => 'Titan',
        'domain' => 'Endurance, the western sky',
        'symbol' => 'Globe, pillar of the heavens',
        'short_description' => 'Titan condemned to hold up the sky at the edge of the world.',
        'full_bio' => "Atlas is a powerful Titan who fights against Zeus in the Titanomachy.
As punishment for siding with Cronus, Zeus sentences him to stand at the western edge of the world and
bear the weight of the heavens on his shoulders.

Later myths show heroes such as Heracles and Perseus encountering Atlas on their travels.
He becomes a symbol of endurance and the heavy burdens placed on those who challenge the new order of gods."
    ],
    [
        'slug' => 'themis',
        'name' => 'Themis',
        'type' => 'Titaness',
        'domain' => 'Divine law, justice, order',
        'symbol' => 'Scales, blindfold, cornucopia',
        'short_description' => 'Personification of divine order, law, and justice.',
        'full_bio' => "Themis is a Titaness who embodies divine law, custom, and the proper order of things.
She advises Zeus and helps maintain balance among gods and mortals, ensuring that oaths and sacred rules
are upheld.

Often depicted with scales and sometimes blindfolded, Themis becomes a symbolic ancestor of modern images
of Justice. She is also mother to the Fates and the Seasons in some traditions."
    ],
    [
        'slug' => 'prometheus',
        'name' => 'Prometheus',
        'type' => 'Titan',
        'domain' => 'Forethought, craft, fire, humanity',
        'symbol' => 'Fire, chained rock',
        'short_description' => 'Trickster Titan who steals fire for humans and suffers eternal punishment.',
        'full_bio' => "Prometheus is a clever Titan known for his sharp intellect and sympathy for humanity.
He shapes humans from clay and repeatedly defies Zeus on their behalf, first by tricking him during a
sacrifice and later by stealing fire from Olympus to give to mortals.

As punishment, Zeus has Prometheus chained to a remote rock where an eagle devours his liver each day,
only for it to regrow at night. In some versions Heracles eventually frees him, making Prometheus a symbol
of suffering rebellion and the cost of progress."
    ],
];


// ========= MONSTERS =========

$characters[] = [
    'slug' => 'minotaur',
    'name' => 'Minotaur',
    'type' => 'Monster',
    'domain' => 'Labyrinth of Crete, terror of sacrifices',
    'symbol' => 'Bull’s head, labyrinth',
    'short_description' => 'Half-man, half-bull monster imprisoned in the Labyrinth.',
    'full_bio' => "The Minotaur dwells in a twisting maze built by Daedalus for King Minos. Fed with human tributes, it was eventually slain by the hero Theseus with the help of Ariadne’s thread."
];

$characters[] = [
    'slug' => 'chimera',
    'name' => 'Chimera',
    'type' => 'Monster',
    'domain' => 'Mountain lairs, fiery destruction',
    'symbol' => 'Lion-goat-serpent body, flames',
    'short_description' => 'Fire-breathing monster combining lion, goat, and serpent.',
    'full_bio' => "The Chimera ravaged the land of Lycia, breathing fire and spreading terror. She was ultimately defeated by the hero Bellerophon riding Pegasus."
];

$characters[] = [
    'slug' => 'sphinx',
    'name' => 'Sphinx',
    'type' => 'Monster',
    'domain' => 'Riddles, crossroads, Thebes',
    'symbol' => 'Lion body, human head, wings',
    'short_description' => 'Riddle-posing monster that terrorized Thebes.',
    'full_bio' => "The Sphinx challenged travelers with deadly riddles. Those who failed were devoured. Oedipus solved her riddle, causing her downfall."
];

$characters[] = [
    'slug' => 'cerberus',
    'name' => 'Cerberus',
    'type' => 'Monster',
    'domain' => 'Gates of the Underworld',
    'symbol' => 'Three-headed hound, chains',
    'short_description' => 'The three-headed dog guarding the Underworld.',
    'full_bio' => "Cerberus guards the entrance to Hades, preventing souls from escaping and the living from entering. Only a few heroes managed to bypass him."
];

$characters[] = [
    'slug' => 'typhon',
    'name' => 'Typhon',
    'type' => 'Monster',
    'domain' => 'Storms, chaos, primal terror',
    'symbol' => 'Serpentine giant, storm clouds',
    'short_description' => 'Father of monsters and one of the deadliest beings in Greek myth.',
    'full_bio' => "Typhon challenged Zeus for control of the cosmos. Their battle shook heaven and earth until Zeus defeated him and buried him under Mount Etna."
];

$characters[] = [
    'slug' => 'medusa',
    'name' => 'Medusa',
    'type' => 'Monster',
    'domain' => 'Cursed temples, petrifying gaze',
    'symbol' => 'Snake hair, stone victims',
    'short_description' => 'Gorgon whose gaze turns onlookers to stone.',
    'full_bio' => "Once a beautiful maiden, Medusa was transformed into a Gorgon. Perseus used a mirrored shield to slay her without meeting her petrifying gaze."
];

$characters[] = [
    'slug' => 'hydra',
    'name' => 'Hydra',
    'type' => 'Monster',
    'domain' => 'Swamps of Lerna, poisonous waters',
    'symbol' => 'Many-headed serpent',
    'short_description' => 'Multi-headed serpent; cut off one head and two regrow.',
    'full_bio' => "The Lernaean Hydra dwelled in a deadly swamp and produced lethal venom. Heracles defeated it by cauterizing each neck as he severed the heads."
];

// ========= HEROES =========

$characters[] = [
    'slug' => 'achilles',
    'name' => 'Achilles',
    'type' => 'Hero',
    'domain' => 'Battle, the Trojan War, unmatched valor',
    'symbol' => 'Spear, shield, his heel',
    'short_description' => 'The greatest warrior of the Trojan War, nearly invincible except for his heel.',
    'full_bio' => "Achilles was the mightiest Greek warrior, dipped in the River Styx by his mother Thetis, rendering him nearly invulnerable. His rage shaped the events of the Trojan War until he was ultimately struck in his one weak spot, his heel."
];

$characters[] = [
    'slug' => 'heracles',
    'name' => 'Heracles',
    'type' => 'Hero',
    'domain' => 'Strength, courage, heroic deeds',
    'symbol' => 'Lion skin, club, bow',
    'short_description' => 'Demigod hero famed for his unmatched strength and the Twelve Labors.',
    'full_bio' => "Heracles, son of Zeus, is the most iconic Greek hero. After being driven mad by Hera, he undertook the Twelve Labors as penance, defeating monsters, capturing beasts, and completing impossible tasks. His legend became a symbol of perseverance and heroism."
];

$characters[] = [
    'slug' => 'perseus',
    'name' => 'Perseus',
    'type' => 'Hero',
    'domain' => 'Monster-slaying, divine favor',
    'symbol' => 'Winged sandals, reflective shield, Medusa’s head',
    'short_description' => 'The slayer of Medusa and rescuer of Andromeda.',
    'full_bio' => "Born of Zeus and Danaë, Perseus was guided by Athena and Hermes to defeat Medusa using a mirrored shield. He later saved Andromeda from a sea monster and became one of Greece’s most celebrated heroes."
];

$characters[] = [
    'slug' => 'odysseus',
    'name' => 'Odysseus',
    'type' => 'Hero',
    'domain' => 'Cunning, strategy, long voyages',
    'symbol' => 'Ship, bow, olive tree',
    'short_description' => 'King of Ithaca, famed for his cleverness and the Odyssey.',
    'full_bio' => "Odysseus was a brilliant strategist in the Trojan War and the architect of the Trojan Horse. His ten-year journey home was filled with trials - Cyclopes, sirens, gods, and storms - making him one of mythology’s most enduring figures."
];

$characters[] = [
    'slug' => 'atalanta',
    'name' => 'Atalanta',
    'type' => 'Hero',
    'domain' => 'Speed, the hunt, independence',
    'symbol' => 'Bow, arrows, wild animals',
    'short_description' => 'A legendary huntress raised by bears, famed for her speed.',
    'full_bio' => "Atalanta was abandoned at birth and raised by a she-bear before joining the world of heroes. Swift and deadly with a bow, she hunted the Calydonian Boar and challenged suitors to footraces, vowing to marry only the man who could outrun her."
];

$stmt = $conn->prepare("
    INSERT INTO characters (slug, name, type, domain, symbol, short_description, full_bio)
    VALUES (?, ?, ?, ?, ?, ?, ?)
    ON DUPLICATE KEY UPDATE
        name = VALUES(name),
        type = VALUES(type),
        domain = VALUES(domain),
        symbol = VALUES(symbol),
        short_description = VALUES(short_description),
        full_bio = VALUES(full_bio)
");

if (!$stmt) {
    die('Prepare failed: ' . $conn->error);
}

foreach ($characters as $c) {
    $stmt->bind_param(
        'sssssss',
        $c['slug'],
        $c['name'],
        $c['type'],
        $c['domain'],
        $c['symbol'],
        $c['short_description'],
        $c['full_bio']
    );
    $stmt->execute();
}

$stmt->close();
$conn->close();

echo 'Character seed completed successfully.';