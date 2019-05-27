-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2019 at 09:04 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--
CREATE DATABASE IF NOT EXISTS `project` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `project`;

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

DROP TABLE IF EXISTS `picture`;
CREATE TABLE `picture` (
  `picture_id` int(6) NOT NULL,
  `path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `picture`
--

TRUNCATE TABLE `picture`;
--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`picture_id`, `path`) VALUES
(1, '/app/images/logo.png'),
(2, '/app/images/noprofilepic.png'),
(19, '/app/images/5c9f80e96e6e3kaneki.jpg'),
(21, '/app/images/5ca40349dae2bb.jpg'),
(27, '/app/images/5ca40da09f75ap.jpg'),
(28, '/app/images/5ca4143e1a0f3p.jpg'),
(29, '/app/images/5ca4166a99b165103463.jpg'),
(30, '/app/images/5ca417170cd86377284.jpg'),
(32, '/app/images/5ca418ea3f2e0728522.jpg'),
(33, '/app/images/5ca419aad92943555411.jpg'),
(34, '/app/images/5ca41ad9e4ce53359675.jpg'),
(35, '/app/images/5ca52c6a90451dog.png'),
(40, '/app/images/5ca530f8d40663882536.jpg'),
(41, '/app/images/5ca54300c9c2b780828.jpg'),
(43, '/app/images/5ca54d8325933621676.jpg'),
(44, '/app/images/5ca553703e83e4674617.jpg'),
(45, '/app/images/5ca553a4c1f784674617.jpg'),
(51, '/app/images/5caccab09b5ea463782257.jpg'),
(53, '/app/images/5cb4ce9c8d260chibi-300x300.jpg'),
(54, '/app/images/5cb61ef8840a52hhh9r.jpg'),
(57, '/app/images/5cb77269399696157923.jpg'),
(58, '/app/images/5cb775645122b220542.jpg'),
(79, '/app/images/5cbf590219854BFV41761_DeliciousAsianDrinks_FBFINAL_v5.jpg'),
(80, '/app/images/5cc88b2238b43cinnamonRoll.jpg'),
(81, '/app/images/5cd3171c71f5fpexels-photo-46710.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `post_id` int(6) NOT NULL,
  `profile_id` int(6) NOT NULL,
  `type_id` int(6) NOT NULL,
  `title` varchar(30) CHARACTER SET utf8 NOT NULL,
  `picture_id` int(6) NOT NULL,
  `description` varchar(250) CHARACTER SET utf8 NOT NULL,
  `ingredients` text CHARACTER SET utf8 NOT NULL,
  `time` varchar(20) CHARACTER SET utf8 NOT NULL,
  `preperation_time` varchar(60) CHARACTER SET utf8 NOT NULL,
  `directions` text CHARACTER SET utf8 NOT NULL,
  `portions` int(11) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `post`
--

TRUNCATE TABLE `post`;
--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `profile_id`, `type_id`, `title`, `picture_id`, `description`, `ingredients`, `time`, `preperation_time`, `directions`, `portions`, `date_posted`) VALUES
(49, 9, 1, 'Flaming Burritos', 21, 'Flaming Burritos', '1 pound ground beef\r\n1 (15 ounce) can black beans, drained and rinsed\r\n1 large red bell pepper chopped\r\n4 (10 inch) flour tortillas\r\n4 cups shredded mozzarella cheese, divided', '12 minutes', '20 minutes', 'Heat a large nonstick skillet over medium heat. Add ground beef; cook and stir until browned, 5 to 10 minutes. Stir in black beans and red bell pepper; cook until heated through, about 5 minutes.\r\nCut four 13x13-inch pieces of aluminum foil.\r\nRinse and dry 4 half-gallon wax-lined milk cartons. Cut several 1-inch diamond-shaped vents into 2 corners of each milk carton, near the bottom. Place a wrapped burrito inside each carton.\r\nPlace milk cartons in a safe cooking area outdoors. Light each on fire at one of the vents; cook until cartons burn down, about 2 minutes. Gently unwrap burritos with heatproof gloves.', 14, '2019-04-03 20:50:13'),
(56, 6, 1, 'Poutine', 27, 'An indulgence of fries, gravy and cheese. A Canadian specialty!', '1 quart vegetable oil for frying\r\n1 (10.25 ounce) can beef gravy\r\n5 medium potatoes, cut into fries\r\n2 cups cheese curds', '20 minutes', '5 minutes', 'Heat oil in a deep fryer or deep heavy skillet to 365 degrees F (185 degrees C). While the oil is heating, you can begin to warm your gravy.\r\nPlace the fries into the hot oil, and cook until light brown, about 5 minutes. Make the fries in batches if necessary to allow them room to move a little in the oil. Remove to a paper towel lined plate to drain.\r\nPlace the fries on a serving platter, and sprinkle the cheese over them. Ladle gravy over the fries and cheese, and serve immediately.', 6, '2019-03-13 20:50:13'),
(58, 9, 5, 'Pancit Canton', 28, 'Cheap !', '1 pack of pancit canton', '5 minutes', '0 minutes', 'Boil it !', 1, '2019-03-03 21:50:13'),
(59, 9, 4, 'Chai Tea Mix', 29, 'Tea', '1 cup nonfat dry milk powder\r\n1 cup powdered non-dairy creamer\r\n1 cup French vanilla flavored powdered non-dairy creamer\r\n2 1/2 cups white sugar\r\n1 1/2 cups unsweetened instant tea\r\n2 teaspoons ground ginger\r\n2 teaspoons ground cinnamon\r\n1 teaspoon ground cloves\r\n1 teaspoon ground cardamom', '30 minutes', '2 minutes', 'In a large bowl, combine milk powder, non-dairy creamer, vanilla flavored creamer, sugar and instant tea. Stir in ginger, cinnamon, cloves and cardamom. In a blender or food processor, blend 1 cup at a time, until mixture is the consistency of fine powder.\r\nTo serve: Stir 2 heaping tablespoons Chai tea mixture into a mug of hot water.', 2, '2019-03-03 21:50:13'),
(60, 9, 3, 'Deep Fried OreosÂ®', 30, 'Carnival Food!', '2 quarts vegetable oil for frying\r\n1 large egg\r\n1 cup milk\r\n2 teaspoons vegetable oil\r\n1 cup pancake mix\r\n1 (18 ounce) package cream-filled chocolate sandwich cookies (such as Oreo&reg;)', '20 minutes', '10 minutes', 'Heat oil in deep-fryer to 375 degrees F (190 degrees C).\r\nWhisk together the egg, milk, and 2 teaspoons of vegetable oil in a bowl until smooth. \r\nStir in the pancake mix until no dry lumps remain. \r\nDip the cookies into the batter one at a time, and carefully place into the hot frying oil. \r\nFry only 4 or 5 at a time to avoid overcrowding the deep fryer. \r\nCook until the cookies are golden-brown, about 2 minutes.\r\n Drain on a paper towel-lined plate before serving', 20, '2019-03-03 21:50:13'),
(61, 6, 1, 'Creamy Bay Scallop Spaghetti', 40, 'Pasta																																												', '8 ounces uncooked thick spaghetti\r\n1 tablespoon vegetable oil\r\n1 pound bay scallops\r\n2 tablespoons butter\r\n3 cloves garlic, minced\r\n2 teaspoons grated lemon zest\r\n1 pinch red pepper flakes\r\n1/3 cup dry sherry\r\n1 cup heavy creamsalt and pepper to taste\r\n1 lemon, juiced\r\n2 tablespoons chopped Italian parsley, divided\r\nFreshly grated Parmigiano-Reggiano cheese, for serving', '20 minutes', '10 minutes', 'Bring a large pot of lightly salted water to a boil. Cook spaghetti in the boiling water, stirring occasionally until tender yet firm to the bite, about 10 minutes or 1 minute less than directed on the package.\r\nHeat oil in a large skillet over high heat. When oil just starts to smoke, add scallops and move them into a single layer. Let sear on high for 60 seconds. Toss to turn. Add butter and stir scallops until butter melts. Stir in garlic. Add lemon zest and red pepper flakes. Stir in sherry and cook and stir until alcohol cooks off, about 1 minute. Pour in cream. When mixture begins to simmer, reduce heat to medium-low. Add salt, pepper, and lemon juice.\r\nDrain pasta. Transfer to skillet with scallops; bring to a simmer. Add half the parsley. Cook until pasta is heated through and tender, about 1 minute. Remove from heat. Grate generously with grated cheese. Add the rest of the parsley. Serve in warm bowls.', 6, '2019-02-12 21:50:13'),
(62, 6, 3, 'Brownies', 32, 'Best brownies in town!', '1/2 cup white sugar\r\n2 tablespoons butter\r\n2 tablespoons water\r\n1 1/2 cups semisweet chocolate chips\r\n2 eggs\r\n1/2 teaspoon vanilla extract\r\n2/3 cup all-purpose flour\r\n1/4 teaspoon baking soda\r\n1/2 teaspoon salt', '25 minutes', '25 minutes', 'Preheat the oven to 325 degrees F (165 degrees C). Grease an 8x8 inch square pan.\r\nIn a medium saucepan, combine the sugar, butter and water. Cook over medium heat until boiling. Remove from heat and stir in chocolate chips until melted and smooth. Mix in the eggs and vanilla. Combine the flour, baking soda and salt; stir into the chocolate mixture. Spread evenly into the prepared pan.\r\nBake for 25 to 30 minutes in the preheated oven, until brownies set up. Do not overbake! Cool in pan and cut into squares.', 30, '2019-02-12 21:50:13'),
(63, 8, 2, 'Arancini', 33, 'An Italian rice ball made with white wine risotto, and a gooey mozzarella center. Fantastic for lunch or dinner - can be frozen', '1 tablespoon olive oil\r\n1 small onion, finely chopped\r\n1 clove garlic, crushed\r\n1 cup uncooked Arborio rice\r\n1/2 cup dry white wine\r\n2 1/2 cups boiling chicken stock\r\n1/2 cup frozen green peas\r\n2 ounces finely chopped hamsalt and pepper to taste\r\n1/2 cup finely grated Parmesan cheese\r\n1 egg, beaten\r\n1 egg\r\n1 tablespoon milk\r\n4 ounces mozzarella cheese, cut into 3/4 inch cubes\r\n1/2 cup all-purpose flour\r\n1 cup dry bread crumbs\r\n1 cup vegetable oil for deep frying', '35 minutes', '20 minutes', 'Heat the olive oil in a large saucepan over medium heat. Add onion and garlic, and cook, stirring until onion is soft but not browned. Pour in the rice, and cook stirring for 2 minutes, then stir in the wine, and continue cooking and stirring until the liquid has evaporated. Add hot chicken stock to the rice 1/3 cup at a time, stirring and cooking until the liquid has evaporated before adding more.\r\nWhen the chicken stock has all been added, and the liquid has evaporated, stir in the peas and ham. Season with salt and pepper. Remove from the heat, and stir in the Parmesan cheese. Transfer the risotto to a bowl, and allow to cool slightly.\r\nStir the beaten egg into the risotto. In a small bowl, whisk together the remaining egg and milk with a fork. For each ball, roll 2 tablespoons of the risotto into a ball. Press a piece of the mozzarella cheese into the center, and roll to enclose. Coat lightly with flour, dip into the milk mixture, then roll in bread crumbs to coat.\r\nHeat oil for frying in a deep-fryer or large deep saucepan to 350 degrees F (175 degrees C). Fry the balls in small batches until evenly golden, turning as needed. Drain on paper towels. Keep warm in a low oven while the rest are frying.', 10, '2019-02-12 21:50:13'),
(64, 14, 1, 'World&#039;s Best Lasagna', 34, 'It takes a little work, but it is worth it.', '1 pound sweet Italian sausage\r\n3/4 pound lean ground beef\r\n1/2 cup minced onion\r\n2 cloves garlic, crushed\r\n1 (28 ounce) can crushed tomatoes2 (6 ounce) cans tomato paste\r\n2 (6.5 ounce) cans canned tomato sauce\r\n1/2 cup water2 tablespoons white sugar\r\n1 1/2 teaspoons dried basil leaves\r\n1/2 teaspoon fennel seeds\r\n1 teaspoon Italian seasoning\r\n1 tablespoon salt\r\n1/4 teaspoon ground black pepper\r\n4 tablespoons chopped fresh parsley\r\n12 lasagna noodles\r\n16 ounces ricotta cheese\r\n1 egg\r\n1/2 teaspoon salt\r\n3/4 pound mozzarella cheese, sliced\r\n3/4 cup grated Parmesan cheese', '2h30', '30 minutes', 'In a Dutch oven, cook sausage, ground beef, onion, and garlic over medium heat until well browned. Stir in crushed tomatoes, tomato paste, tomato sauce, and water. Season with sugar, basil, fennel seeds, Italian seasoning, 1 tablespoon salt, pepper, and 2 tablespoons parsley. Simmer, covered, for about 1 1/2 hours, stirring occasionally.\r\nBring a large pot of lightly salted water to a boil. Cook lasagna noodles in boiling water for 8 to 10 minutes. Drain noodles, and rinse with cold water. In a mixing bowl, combine ricotta cheese with egg, remaining parsley, and 1/2 teaspoon salt.\r\nPreheat oven to 375 degrees F (190 degrees C).\r\nTo assemble, spread 1 1/2 cups of meat sauce in the bottom of a 9x13 inch baking dish. Arrange 6 noodles lengthwise over meat sauce. Spread with one half of the ricotta cheese mixture. Top with a third of mozzarella cheese slices. Spoon 1 1/2 cups meat sauce over mozzarella, and sprinkle with 1/4 cup Parmesan cheese. Repeat layers, and top with remaining mozzarella and Parmesan cheese. Cover with foil: to prevent sticking, either spray foil with cooking spray, or make sure the foil does not touch the cheese.\r\nBake in preheated oven for 25 minutes. Remove foil, and bake an additional 25 minutes. Cool for 15 minutes before serving.', 20, '2019-03-18 20:50:13'),
(66, 6, 3, 'Cream Filled Cupcakes', 43, 'Delicious and simple to make, a creamy filling is piped into chocolate cupcakes with a pastry bag. Frost with your favorite chocolate frosting', '3 cups all-purpose flour\r\n2 cups white sugar\r\n1/3 cup unsweetened cocoa powder\r\n2 teaspoons baking soda\r\n1 teaspoon salt\r\n2 eggs\r\n1 cup milk\r\n1 cup water\r\n1 cup vegetable oil\r\n1 teaspoon vanilla extract\r\n1/4 cup butter\r\n1/4 cup shortening\r\n2 cups confectioners&#039; sugar\r\n1 pinch salt\r\n3 tablespoons milk\r\n1 teaspoon vanilla extract', '15 minutes', '20 minutes', 'Preheat oven to 375 degrees F (190 degrees C). Line 36 muffin cups with paper liners.\r\nIn a large bowl, mix together the flour, sugar, cocoa, baking soda and 1 teaspoon salt. Make a well in the center and pour in the eggs, 1 cup milk, water, oil and 1 teaspoon vanilla. Mix well. Fill each muffin cup half-full of batter.\r\nBake in the preheated oven for 15 to 20 minutes, or until a toothpick inserted into the center of the cake comes out clean. Allow to cool.\r\nMake filling: In a large bowl, beat butter and shortening together until smooth. Blend in confectioners&#039; sugar and pinch of salt. Gradually beat in 3 tablespoons milk and 1 teaspoon vanilla. beat until light and fluffy. Fill a pastry bag with a small tip. Push tip through bottom of paper liner to fill each cupcake.', 15, '2019-03-18 20:50:13'),
(67, 15, 2, 'Chef John\'s Croissants', 45, 'Croissants', '1 cup warm water (100 degrees F or 38 degrees C)\r\n1 (.25 ounce) package active dry yeast\r\n1/4 cup granulated white sugar\r\n3 1/2 cups unbleached bread flour\r\n3 teaspoons kosher salt\r\n6 tablespoons butter, room temperature, cut into pieces\r\n2 sticks unsalted European-style butter - Croissants\r\n1 egg - Croissants\r\n1 tablespoon water - Croissants', '30 minutes', '30 minutes', 'Place warm water in the bowl of a stand mixer. Sprinkle with yeast. Let yeast dissolve for 10 minutes. Add sugar and bread flour. Sprinkle with salt; add 6 tablespoons butter. Attach the bowl to the stand mixer. Mix dough with the dough hook just until butter is completely kneaded in and the dough forms a ball and pulls away cleanly from the sides of the bowl, 3 or 4 minutes.\r\nTransfer dough to a work surface and form into a semi-smooth ball. Place dough back in the mixer bowl; cover. Let rise in a warm spot until doubled, about 2 hours.\r\nTransfer dough to a lightly floured work surface. Push and press dough to deflate it, and form it into a rectangle. Fold into thirds by lifting one end over the middle third, and folding the other side onto the middle. Wrap in plastic wrap. Place on a rimmed baking sheet lined with a silicone mat. Refrigerate until chilled through, about 1 hour.\r\nCut 2 sticks butter in half lengthwise and place slightly apart from each other on a length of parchment paper long enough to fold over the butter. Fold the parchment paper over the butter. Press butter down. Roll out with a rolling pin to a square about 8x8 inches. Refrigerate until a little chilled and just barely flexible, 10 or 15 minutes.\r\nRoll dough out into a rectangle slightly wider than the butter slab and just over twice as long. Place butter on one half of the dough leaving about 1 inch margin from the edge of the dough. Fold the other half of the dough over the butter. Dust work surface and dough with flour as needed.\r\nPress rolling pin down on dough to create ridges. Then roll out the ridges. Repeat this process. Keep pressing and rolling until dough is about the same size rectangle as you had before you folded it in half, dusting with just a bit of flour as necessary.\r\nStarting from the short side, fold one-third of dough over middle third. Then fold the other end over to form a small rectangle. Flatten out just slightly with rolling pin. Transfer to the silicone-lined baking sheet; cover with plastic wrap. Refrigerate until chilled, about 30 minutes.\r\nTransfer dough back to work surface and repeat pressing and rolling technique until dough is the size of the previous larger rectangle. Fold into thirds again, starting from the short side. Press and roll slightly. Transfer back to lined baking sheet. Cover and refrigerate about 15 minutes.\r\nRoll back out to a large rectangle. This time, fold dough in half. Then press and roll out into a 1/2-inch thick rectangle, using as little flour as needed to keep dough from sticking.\r\nCut dough in half lengthwise using a pastry wheel or pizza cutter. Dust one piece with flour and roll out to a rectangle about 1/4 to 1/8 inch thick. Starting from one corner, cut the dough diagonally crosswise into 8 triangles using a pastry wheel. Starting with the bottom end of each triangle, roll each up toward the tip to form the croissant with the seam at the bottom. If necessary, use a bit of water to seal the tip to the rolled croissant.\r\nRepeat with the other half of the dough.\r\nPlace shaped croissants on baking sheets lined with silicone mats. Whisk together egg and 1 tablespoon water to make the egg wash. Brush croissants with egg wash. Place in a warm area to allow them to rise, about 45 to 60 minutes.\r\nPreheat oven to 400 degrees F (200 degrees C). Brush croissants gently but thoroughly again with egg wash.\r\nBake in preheated oven until beautifully browned, about 25 minutes. Transfer to a cooling rack. Cool to room temperature before serving.', 24, '2019-03-18 20:50:13'),
(73, 6, 5, 'rice', 51, 'Put it in the rice cooker', 'rice', '20 minutes', '10 minutes', 'Pour 3 cups of water\r\nWash the rice before pouring inside the rice cooker\r\nAfter a clean wash, pour that shit in the rice cooker\r\n\r\n\r\n', 5, '2019-04-19 20:50:13'),
(76, 21, 5, 'Sushi Rice', 57, 'Here is my recipe for the perfect sushi rice.', '2 cups uncooked glutinous white rice (sushi rice)\r\n3 cups water\r\n1/2 cup rice vinegar\r\n1 tablespoon vegetable oil\r\n1/4 cup white sugar\r\n1 teaspoon salt', '20 minutes', '25 minutes', 'Rinse the rice in a strainer or colander until the water runs clear. Combine with water in a medium saucepan. Bring to a boil, then reduce the heat to low, cover and cook for 20 minutes. Rice should be tender and water should be absorbed. Cool until cool enough to handle.\r\nIn a small saucepan, combine the rice vinegar, oil, sugar and salt. Cook over medium heat until the sugar dissolves. Cool, then stir into the cooked rice. When you pour this in to the rice it will seem very wet. Keep stirring and the rice will dry as it cools.', 100, '2019-04-19 20:50:13'),
(77, 21, 1, 'Mohammed\'s Jerk Chicken', 58, 'This is one of my nephew&#039;s favorite grilled recipes.', '6 green onions, chopped\r\n1 onion, chopped\r\n1 jalapeno pepper, seeded and minced\r\n3/4 cup soy sauce\r\n1/2 cup distilled white vinegar\r\n1/4 cup vegetable oil\r\n2 tablespoons brown sugar\r\n1 tablespoon chopped fresh thyme\r\n1/2 teaspoon ground cloves\r\n1/2 teaspoon ground nutmeg\r\n1/2 teaspoon ground allspice\r\n1 1/2 pounds skinless, boneless chicken breast halves', '30 minutes', '4h56', 'In a food processor or blender, combine the green onions, onion, jalapeno pepper, soy sauce, vinegar, vegetable oil, brown sugar, thyme, cloves, nutmeg and allspice. Mix for about 15 seconds.\r\nPlace the chicken in a medium bowl, and coat with the marinade. Refrigerate for 4 to 6 hours, or overnight.\r\nPreheat grill for high heat.\r\nLightly oil grill grate. Cook chicken on the prepared grill 6 to 8 minutes, until juices run clear.', 20, '2019-04-19 20:50:13'),
(78, 14, 4, 'Classic Bubble Tea Recipe', 79, 'Iced tea with tapioca pearls that are sucked from a large straw are perhaps Taiwan&rsquo;s most famous culinary export.', '1 cup tapioca pearls (found in the dry goods section in Asian groceries)\r\n4 cups freshly brewed strong black tea\r\n1 tablespoon sugar\r\nIce cubes, for shaking\r\n1/2 cup whole milk', '10 minutes', '2h10', 'Soak the tapioca pearls according to the package instructions. Once fully reconstituted and softened, drain.\r\nWhile the tea is still hot or warm, add the sugar and stir to dissolve completely. Let cool and then refrigerate until completely chilled, about 2 hours, before serving.\r\nPlace the tapioca pearls at the bottom of 2 cups. Use a cocktail shaker to shake together the ice, milk, and tea and strain into each cup and serve.', 5, '2019-04-23 18:17:20'),
(79, 25, 5, 'Buttermilk Cinnamon Rolls', 80, 'An amazing Recipe !', '2 (.25 ounce) packages active dry yeast\r\n1/4 cup warm water (110 degrees F/45 degrees C)\r\n1 1/2 cups buttermilk\r\n1/2 cup vegetable oil\r\n4 1/2 cups all-purpose flour\r\n1 teaspoon salt\r\n1/2 teaspoon baking soda\r\n1/2 cup butter, melted\r\n1 1/4 cups brown sugar\r\n1 1/2 teaspoons ground cinnamon', '25 minutes', '30 minutes', 'In a large bowl, dissolve yeast in warm water. Let stand until creamy, about 10 minutes. In a small saucepan, heat the buttermilk until warm to the touch.\r\nPour the buttermilk and oil into the yeast mixture; mix well. Combine the flour, salt and baking soda. Stir the flour mixture into the liquid 1 cup at a time, until a soft dough forms. Turn dough out onto a lightly floured surface and knead 20 times. Cover and let rest for 15 minutes. In a small bowl, stir together the butter, brown sugar and cinnamon.\r\nOn a lightly floured surface, roll dough out into a large rectangle. Spread the brown sugar and butter mixture over the dough, roll up into a log and pinch the seam to seal. Slice into 1 inch pieces and place cut side up in a lightly greased 10x15 baking pan. Cover and let rise 30 minutes or cover and refrigerate overnight. If baking immediately, preheat oven to 400 degrees F (200 degrees C).\r\nBake in preheated oven for 20 to 25 minutes, until golden brown. Let stand for 2 to 3 minutes before serving.', 15, '2019-04-30 17:51:30'),
(80, 6, 3, 'CAke', 1, 'A good cake', 'flour\r\nchocolate', '20 minutes', '20 minutes', 'put it in the oven', 20, '2019-05-08 17:48:42');

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

DROP TABLE IF EXISTS `privilege`;
CREATE TABLE `privilege` (
  `privilege_id` int(1) NOT NULL,
  `description` varchar(15) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `privilege`
--

TRUNCATE TABLE `privilege`;
--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`privilege_id`, `description`) VALUES
(1, 'admin'),
(2, 'non-admin');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `profile_id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  `first_name` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_name` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `picture_id` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `profile`
--

TRUNCATE TABLE `profile`;
--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profile_id`, `user_id`, `first_name`, `last_name`, `picture_id`) VALUES
(6, 7, 'Jim', 'Ibarra', 2),
(8, 21, 'John', 'David', 2),
(9, 22, 'John', 'Doe', 2),
(14, 27, 'Tara', 'S', 53),
(15, 28, 'The', 'Account', 2),
(16, 29, 'Tara', 'LLLLL', 2),
(17, 30, '1234', '1234', 2),
(21, 33, 'Mohammed', 'AS', 54),
(22, 34, 'David', 'Do', 2),
(24, 41, 'a', 'a', 2),
(25, 43, 'John', 'Doe', 2),
(26, 44, 'K', 'k', 81);

-- --------------------------------------------------------

--
-- Table structure for table `relation`
--

DROP TABLE IF EXISTS `relation`;
CREATE TABLE `relation` (
  `profile_id_follower` int(11) NOT NULL,
  `profile_id_follow` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `relation`
--

TRUNCATE TABLE `relation`;
--
-- Dumping data for table `relation`
--

INSERT INTO `relation` (`profile_id_follower`, `profile_id_follow`) VALUES
(14, 15),
(14, 6),
(16, 6),
(14, 17),
(6, 15),
(6, 14),
(14, 8),
(21, 6),
(6, 8);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE `review` (
  `review_id` int(6) NOT NULL,
  `profile_id` int(6) NOT NULL,
  `post_id` int(6) NOT NULL,
  `review_content` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `review`
--

TRUNCATE TABLE `review`;
--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `profile_id`, `post_id`, `review_content`, `rating`) VALUES
(24, 16, 63, 'Not bad! ', 3),
(25, 16, 59, 'Good', 5),
(33, 14, 62, '1', 1),
(39, 21, 73, 'where the chicken\r\n', 1),
(43, 22, 77, 'scrumptious9', 5),
(44, 6, 67, 'Good!', 5),
(45, 6, 76, 'Niceee', 2),
(46, 6, 64, 'Its good !!', 5),
(47, 6, 77, 'Sucks', 1),
(50, 25, 49, 'Good!', 5),
(51, 21, 56, 'AMAZING !!', 5),
(52, 6, 79, 'Amazing', 1);

-- --------------------------------------------------------

--
-- Table structure for table `savedpost`
--

DROP TABLE IF EXISTS `savedpost`;
CREATE TABLE `savedpost` (
  `savedPost_id` int(6) NOT NULL,
  `profile_id` int(6) NOT NULL,
  `post_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `savedpost`
--

TRUNCATE TABLE `savedpost`;
--
-- Dumping data for table `savedpost`
--

INSERT INTO `savedpost` (`savedPost_id`, `profile_id`, `post_id`) VALUES
(59, 9, 58),
(61, 9, 56),
(62, 14, 64),
(64, 14, 63),
(74, 16, 63),
(78, 16, 62),
(82, 14, 67),
(83, 17, 67),
(86, 6, 66),
(87, 6, 67),
(88, 22, 77),
(89, 22, 76),
(90, 22, 66),
(91, 6, 78),
(92, 21, 79),
(93, 21, 78),
(94, 6, 79);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `type_id` int(6) NOT NULL,
  `description` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `type`
--

TRUNCATE TABLE `type`;
--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `description`) VALUES
(1, 'Main Dish'),
(2, 'Appetizer'),
(3, 'Dessert'),
(4, 'Drink'),
(5, 'Other'),
(6, 'All');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(6) NOT NULL,
  `username` varchar(30) CHARACTER SET utf8 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `privilege_id` int(1) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `user`
--

TRUNCATE TABLE `user`;
--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `privilege_id`) VALUES
(7, 'jimmy', '$2y$10$QJCIqrixT1eAnZD6Hf0qB.vftjLcMfvE.fjAfF5Ps5b8CVtkrJ5wm', 1),
(21, 'john', '$2y$10$ZZge56dh8IVFfRebvTIHoO5OdVNPlQLa8ZfKRls2V0b0uoz9aLO9W', 2),
(22, 'new', '$2y$10$wntqciOAi3NshtiH1c5qd.X7ESAEnQdDqWjov1SuwLoQAfWutFDem', 2),
(27, 'tara', '$2y$10$6Z4owmDDiPUJzY/UWSa.MOJ.quC/Ou5crTqrU5JuZK5LiQkArEGKa', 2),
(28, '123', '$2y$10$g7EG7hHTB9.VjuJ7k67QO.DO5d7f5V9AFNzC65xxgNcJ74nG6amFa', 2),
(29, '123456', '$2y$10$kLG51qfkhVTnRP8Mm93uc.KE78/hs53cYIRLjPBG1VuuMlRdPSR4O', 2),
(30, '1234', '$2y$10$tNartzcITfHmcUOTbLusYuZ5fzkTLZXUONGuk2C.OJlADW5BHwC6C', 2),
(33, 'mohammed', '$2y$10$nP/e0PuIxL6Klc3LeS1VFe0NLi/.zD75VLZD4cHbrNDKq3nYEYinu', 2),
(34, 'david', '$2y$10$2Ncfl7VkhRgVOnsAiTi1f.cpLei3l.ac9PtfVtbjz.Y9iDU7dhMr6', 2),
(35, 'taratara3', '$2y$10$yg7SmDS8Rw5G5p8sxoiZMePqw.L72/9BZi9b8tZI6mxvrgBdyXEbW', 2),
(36, '1234567890', '$2y$10$HFKkpRXb/8tQLjyHGczBY.LupWd/FTEajA7jt5PxZVtDuCzYXnbeu', 2),
(39, 'bbc123', '$2y$10$q7TNURU0z9QKCTETbNvYpO/LxkMVbJokmy7cTDD9hug.aPGSV2ebK', 2),
(41, 'a', '$2y$10$5h9.jjhqisjhzEACbcMgvesHYZNK0yU99ngr.h9qU/wGM1XMWQRGO', 2),
(42, '', '$2y$10$yS7L9QyhERDhjJwI3R59XufDxbGG6nrbj9WEdrXKq4QdYVlJRlH.S', 2),
(43, 'Jim', '$2y$10$Duictc3Vz5d10Tnqja4xL.dwkbksUdw0MY.6VOIJPtnyQg.cDI0Ze', 2),
(44, 'k', '$2y$10$HJ5UszBzqBN2BAHB8YgDmeoL3Vm1rEcloAKFv6ZKft8Z1gZFASrVe', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`picture_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `FK_profile_post` (`profile_id`),
  ADD KEY `FK_profile_type` (`type_id`),
  ADD KEY `FK_profile_picture` (`picture_id`);

--
-- Indexes for table `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`privilege_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `profile_to_user` (`user_id`),
  ADD KEY `profile_to_picture_id_FK` (`picture_id`);

--
-- Indexes for table `relation`
--
ALTER TABLE `relation`
  ADD KEY `relation_to_profile_follow_FK` (`profile_id_follow`),
  ADD KEY `relation_to_profile_follower_FK` (`profile_id_follower`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `review_to_post` (`post_id`),
  ADD KEY `review_to_profile_FK_FK` (`profile_id`);

--
-- Indexes for table `savedpost`
--
ALTER TABLE `savedpost`
  ADD PRIMARY KEY (`savedPost_id`),
  ADD KEY `savedPost_to_profile` (`profile_id`),
  ADD KEY `savedPost_to_post` (`post_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_to_privilege_FK` (`privilege_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `picture`
--
ALTER TABLE `picture`
  MODIFY `picture_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profile_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `savedpost`
--
ALTER TABLE `savedpost`
  MODIFY `savedPost_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `type_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_profile_picture` FOREIGN KEY (`picture_id`) REFERENCES `picture` (`picture_id`),
  ADD CONSTRAINT `FK_profile_post` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`profile_id`),
  ADD CONSTRAINT `FK_profile_type` FOREIGN KEY (`type_id`) REFERENCES `type` (`type_id`);

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_to_picture_id_FK` FOREIGN KEY (`picture_id`) REFERENCES `picture` (`picture_id`),
  ADD CONSTRAINT `profile_to_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `relation`
--
ALTER TABLE `relation`
  ADD CONSTRAINT `relation_to_profile_follow_FK` FOREIGN KEY (`profile_id_follow`) REFERENCES `profile` (`profile_id`),
  ADD CONSTRAINT `relation_to_profile_follower_FK` FOREIGN KEY (`profile_id_follower`) REFERENCES `profile` (`profile_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_to_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`),
  ADD CONSTRAINT `review_to_profile_FK_FK` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`profile_id`);

--
-- Constraints for table `savedpost`
--
ALTER TABLE `savedpost`
  ADD CONSTRAINT `savedPost_to_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`),
  ADD CONSTRAINT `savedPost_to_profile` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`profile_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_to_privilege_FK` FOREIGN KEY (`privilege_id`) REFERENCES `privilege` (`privilege_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
