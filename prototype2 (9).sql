-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 23, 2024 at 06:27 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prototype2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `email`, `password`) VALUES
(1, 'ajayupadhyay@99notes.in', '$2y$10$9F9tpuXDU5fNj7Bcsw5x8.x2iMIX1CFCMXC4KhIpCSg49kLvDoM2q');

-- --------------------------------------------------------

--
-- Table structure for table `average_score`
--

CREATE TABLE `average_score` (
  `id` int(11) NOT NULL,
  `average` float NOT NULL,
  `cutoff` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `average_score`
--

INSERT INTO `average_score` (`id`, `average`, `cutoff`) VALUES
(1, 50.0546, 100.055),
(2, 50.0635, 100.064),
(3, 49.9871, 99.9871),
(4, 49.9786, 99.9786),
(5, 50.0643, 100.064),
(6, 50.0385, 100.039),
(7, 50.0385, 100.039),
(8, 50.0428, 100.043),
(9, 50.0642, 100.064),
(10, 50.0496, 100.05);

-- --------------------------------------------------------

--
-- Table structure for table `master_tags`
--

CREATE TABLE `master_tags` (
  `id` int(11) NOT NULL,
  `masterTag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_tags`
--

INSERT INTO `master_tags` (`id`, `masterTag`) VALUES
(1, 'UPSC CSE');

-- --------------------------------------------------------

--
-- Table structure for table `pre_questions`
--

CREATE TABLE `pre_questions` (
  `question_id` int(11) NOT NULL,
  `set_id` varchar(5) NOT NULL,
  `question_number` int(11) NOT NULL,
  `correct_answer` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pre_questions`
--

INSERT INTO `pre_questions` (`question_id`, `set_id`, `question_number`, `correct_answer`) VALUES
(1201, 'A', 1, 'A'),
(1202, 'B', 1, 'D'),
(1203, 'C', 1, 'A'),
(1204, 'D', 1, 'D'),
(1205, 'A', 2, 'A'),
(1206, 'B', 2, 'D'),
(1207, 'C', 2, 'D'),
(1208, 'D', 2, 'A'),
(1209, 'A', 3, 'D'),
(1210, 'B', 3, 'D'),
(1211, 'C', 3, 'A'),
(1212, 'D', 3, 'B'),
(1213, 'A', 4, 'A'),
(1214, 'B', 4, 'D'),
(1215, 'C', 4, 'B'),
(1216, 'D', 4, 'D'),
(1217, 'A', 5, 'C'),
(1218, 'B', 5, 'B'),
(1219, 'C', 5, 'C'),
(1220, 'D', 5, 'C'),
(1221, 'A', 6, 'B'),
(1222, 'B', 6, 'C'),
(1223, 'C', 6, 'C'),
(1224, 'D', 6, 'D'),
(1225, 'A', 7, 'B'),
(1226, 'B', 7, 'B'),
(1227, 'C', 7, 'D'),
(1228, 'D', 7, 'D'),
(1229, 'A', 8, 'B'),
(1230, 'B', 8, 'C'),
(1231, 'C', 8, 'D'),
(1232, 'D', 8, 'C'),
(1233, 'A', 9, 'B'),
(1234, 'B', 9, 'C'),
(1235, 'C', 9, 'B'),
(1236, 'D', 9, 'A'),
(1237, 'A', 10, 'B'),
(1238, 'B', 10, 'A'),
(1239, 'C', 10, 'B'),
(1240, 'D', 10, 'A'),
(1241, 'A', 11, 'A'),
(1242, 'B', 11, 'B'),
(1243, 'C', 11, 'C'),
(1244, 'D', 11, 'D'),
(1245, 'A', 12, 'D'),
(1246, 'B', 12, 'A'),
(1247, 'C', 12, 'D'),
(1248, 'D', 12, 'A'),
(1249, 'A', 13, 'D'),
(1250, 'B', 13, 'A'),
(1251, 'C', 13, 'C'),
(1252, 'D', 13, 'C'),
(1253, 'A', 14, 'C'),
(1254, 'B', 14, 'B'),
(1255, 'C', 14, 'B'),
(1256, 'D', 14, 'C'),
(1257, 'A', 15, 'D'),
(1258, 'B', 15, 'D'),
(1259, 'C', 15, 'B'),
(1260, 'D', 15, 'B'),
(1261, 'A', 16, 'B'),
(1262, 'B', 16, 'D'),
(1263, 'C', 16, 'D'),
(1264, 'D', 16, 'D'),
(1265, 'A', 17, 'D'),
(1266, 'B', 17, 'D'),
(1267, 'C', 17, 'B'),
(1268, 'D', 17, 'A'),
(1269, 'A', 18, 'C'),
(1270, 'B', 18, 'A'),
(1271, 'C', 18, 'C'),
(1272, 'D', 18, 'C'),
(1273, 'A', 19, 'C'),
(1274, 'B', 19, 'D'),
(1275, 'C', 19, 'C'),
(1276, 'D', 19, 'D'),
(1277, 'A', 20, 'C'),
(1278, 'B', 20, 'C'),
(1279, 'C', 20, 'D'),
(1280, 'D', 20, 'A'),
(1281, 'A', 21, 'C'),
(1282, 'B', 21, 'A'),
(1283, 'C', 21, 'D'),
(1284, 'D', 21, 'C'),
(1285, 'A', 22, 'A'),
(1286, 'B', 22, 'D'),
(1287, 'C', 22, 'A'),
(1288, 'D', 22, 'D'),
(1289, 'A', 23, 'D'),
(1290, 'B', 23, 'D'),
(1291, 'C', 23, 'B'),
(1292, 'D', 23, 'C'),
(1293, 'A', 24, 'A'),
(1294, 'B', 24, 'C'),
(1295, 'C', 24, 'D'),
(1296, 'D', 24, 'B'),
(1297, 'A', 25, 'A'),
(1298, 'B', 25, 'D'),
(1299, 'C', 25, 'C'),
(1300, 'D', 25, 'B'),
(1301, 'A', 26, 'A'),
(1302, 'B', 26, 'B'),
(1303, 'C', 26, 'D'),
(1304, 'D', 26, 'D'),
(1305, 'A', 27, 'D'),
(1306, 'B', 27, 'D'),
(1307, 'C', 27, 'D'),
(1308, 'D', 27, 'B'),
(1309, 'A', 28, 'A'),
(1310, 'B', 28, 'C'),
(1311, 'C', 28, 'A'),
(1312, 'D', 28, 'A'),
(1313, 'A', 29, 'C'),
(1314, 'B', 29, 'C'),
(1315, 'C', 29, 'A'),
(1316, 'D', 29, 'C'),
(1317, 'A', 30, 'A'),
(1318, 'B', 30, 'C'),
(1319, 'C', 30, 'A'),
(1320, 'D', 30, 'D'),
(1321, 'A', 31, 'B'),
(1322, 'B', 31, 'A'),
(1323, 'C', 31, 'D'),
(1324, 'D', 31, 'B'),
(1325, 'A', 32, 'A'),
(1326, 'B', 32, 'A'),
(1327, 'C', 32, 'A'),
(1328, 'D', 32, 'C'),
(1329, 'A', 33, 'A'),
(1330, 'B', 33, 'D'),
(1331, 'C', 33, 'C'),
(1332, 'D', 33, 'D'),
(1333, 'A', 34, 'B'),
(1334, 'B', 34, 'A'),
(1335, 'C', 34, 'C'),
(1336, 'D', 34, 'B'),
(1337, 'A', 35, 'D'),
(1338, 'B', 35, 'C'),
(1339, 'C', 35, 'D'),
(1340, 'D', 35, 'B'),
(1341, 'A', 36, 'D'),
(1342, 'B', 36, 'B'),
(1343, 'C', 36, 'D'),
(1344, 'D', 36, 'A'),
(1345, 'A', 37, 'D'),
(1346, 'B', 37, 'B'),
(1347, 'C', 37, 'A'),
(1348, 'D', 37, 'B'),
(1349, 'A', 38, 'C'),
(1350, 'B', 38, 'B'),
(1351, 'C', 38, 'C'),
(1352, 'D', 38, 'B'),
(1353, 'A', 39, 'D'),
(1354, 'B', 39, 'B'),
(1355, 'C', 39, 'D'),
(1356, 'D', 39, 'C'),
(1357, 'A', 40, 'C'),
(1358, 'B', 40, 'B'),
(1359, 'C', 40, 'A'),
(1360, 'D', 40, 'C'),
(1361, 'A', 41, 'D'),
(1362, 'B', 41, 'C'),
(1363, 'C', 41, 'B'),
(1364, 'D', 41, 'A'),
(1365, 'A', 42, 'D'),
(1366, 'B', 42, 'A'),
(1367, 'C', 42, 'C'),
(1368, 'D', 42, 'D'),
(1369, 'A', 43, 'D'),
(1370, 'B', 43, 'D'),
(1371, 'C', 43, 'D'),
(1372, 'D', 43, 'A'),
(1373, 'A', 44, 'D'),
(1374, 'B', 44, 'A'),
(1375, 'C', 44, 'B'),
(1376, 'D', 44, 'B'),
(1377, 'A', 45, 'B'),
(1378, 'B', 45, 'A'),
(1379, 'C', 45, 'B'),
(1380, 'D', 45, 'A'),
(1381, 'A', 46, 'C'),
(1382, 'B', 46, 'A'),
(1383, 'C', 46, 'A'),
(1384, 'D', 46, 'C'),
(1385, 'A', 47, 'B'),
(1386, 'B', 47, 'D'),
(1387, 'C', 47, 'B'),
(1388, 'D', 47, 'D'),
(1389, 'A', 48, 'C'),
(1390, 'B', 48, 'A'),
(1391, 'C', 48, 'B'),
(1392, 'D', 48, 'D'),
(1393, 'A', 49, 'C'),
(1394, 'B', 49, 'C'),
(1395, 'C', 49, 'A'),
(1396, 'D', 49, 'B'),
(1397, 'A', 50, 'A'),
(1398, 'B', 50, 'A'),
(1399, 'C', 50, 'C'),
(1400, 'D', 50, 'B'),
(1401, 'A', 51, 'B'),
(1402, 'B', 51, 'A'),
(1403, 'C', 51, 'D'),
(1404, 'D', 51, 'A'),
(1405, 'A', 52, 'C'),
(1406, 'B', 52, 'D'),
(1407, 'C', 52, 'D'),
(1408, 'D', 52, 'A'),
(1409, 'A', 53, 'D'),
(1410, 'B', 53, 'A'),
(1411, 'C', 53, 'D'),
(1412, 'D', 53, 'D'),
(1413, 'A', 54, 'B'),
(1414, 'B', 54, 'B'),
(1415, 'C', 54, 'D'),
(1416, 'D', 54, 'A'),
(1417, 'A', 55, 'B'),
(1418, 'B', 55, 'C'),
(1419, 'C', 55, 'B'),
(1420, 'D', 55, 'C'),
(1421, 'A', 56, 'A'),
(1422, 'B', 56, 'C'),
(1423, 'C', 56, 'C'),
(1424, 'D', 56, 'B'),
(1425, 'A', 57, 'B'),
(1426, 'B', 57, 'D'),
(1427, 'C', 57, 'B'),
(1428, 'D', 57, 'B'),
(1429, 'A', 58, 'B'),
(1430, 'B', 58, 'D'),
(1431, 'C', 58, 'C'),
(1432, 'D', 58, 'B'),
(1433, 'A', 59, 'A'),
(1434, 'B', 59, 'B'),
(1435, 'C', 59, 'C'),
(1436, 'D', 59, 'B'),
(1437, 'A', 60, 'C'),
(1438, 'B', 60, 'B'),
(1439, 'C', 60, 'A'),
(1440, 'D', 60, 'B'),
(1441, 'A', 61, 'D'),
(1442, 'B', 61, 'C'),
(1443, 'C', 61, 'B'),
(1444, 'D', 61, 'C'),
(1445, 'A', 62, 'A'),
(1446, 'B', 62, 'D'),
(1447, 'C', 62, 'A'),
(1448, 'D', 62, 'A'),
(1449, 'A', 63, 'C'),
(1450, 'B', 63, 'C'),
(1451, 'C', 63, 'A'),
(1452, 'D', 63, 'D'),
(1453, 'A', 64, 'C'),
(1454, 'B', 64, 'B'),
(1455, 'C', 64, 'B'),
(1456, 'D', 64, 'A'),
(1457, 'A', 65, 'D'),
(1458, 'B', 65, 'B'),
(1459, 'C', 65, 'D'),
(1460, 'D', 65, 'A'),
(1461, 'A', 66, 'D'),
(1462, 'B', 66, 'D'),
(1463, 'C', 66, 'D'),
(1464, 'D', 66, 'A'),
(1465, 'A', 67, 'A'),
(1466, 'B', 67, 'B'),
(1467, 'C', 67, 'B'),
(1468, 'D', 67, 'D'),
(1469, 'A', 68, 'C'),
(1470, 'B', 68, 'A'),
(1471, 'C', 68, 'C'),
(1472, 'D', 68, 'A'),
(1473, 'A', 69, 'D'),
(1474, 'B', 69, 'C'),
(1475, 'C', 69, 'D'),
(1476, 'D', 69, 'C'),
(1477, 'A', 70, 'A'),
(1478, 'B', 70, 'D'),
(1479, 'C', 70, 'C'),
(1480, 'D', 70, 'A'),
(1481, 'A', 71, 'D'),
(1482, 'B', 71, 'D'),
(1483, 'C', 71, 'C'),
(1484, 'D', 71, 'A'),
(1485, 'A', 72, 'A'),
(1486, 'B', 72, 'A'),
(1487, 'C', 72, 'A'),
(1488, 'D', 72, 'D'),
(1489, 'A', 73, 'B'),
(1490, 'B', 73, 'C'),
(1491, 'C', 73, 'D'),
(1492, 'D', 73, 'D'),
(1493, 'A', 74, 'D'),
(1494, 'B', 74, 'C'),
(1495, 'C', 74, 'A'),
(1496, 'D', 74, 'C'),
(1497, 'A', 75, 'C'),
(1498, 'B', 75, 'D'),
(1499, 'C', 75, 'A'),
(1500, 'D', 75, 'D'),
(1501, 'A', 76, 'D'),
(1502, 'B', 76, 'D'),
(1503, 'C', 76, 'A'),
(1504, 'D', 76, 'B'),
(1505, 'A', 77, 'D'),
(1506, 'B', 77, 'A'),
(1507, 'C', 77, 'D'),
(1508, 'D', 77, 'D'),
(1509, 'A', 78, 'C'),
(1510, 'B', 78, 'C'),
(1511, 'C', 78, 'A'),
(1512, 'D', 78, 'C'),
(1513, 'A', 79, 'A'),
(1514, 'B', 79, 'D'),
(1515, 'C', 79, 'C'),
(1516, 'D', 79, 'C'),
(1517, 'A', 80, 'A'),
(1518, 'B', 80, 'A'),
(1519, 'C', 80, 'A'),
(1520, 'D', 80, 'C'),
(1521, 'A', 81, 'C'),
(1522, 'B', 81, 'B'),
(1523, 'C', 81, 'A'),
(1524, 'D', 81, 'D'),
(1525, 'A', 82, 'D'),
(1526, 'B', 82, 'C'),
(1527, 'C', 82, 'D'),
(1528, 'D', 82, 'D'),
(1529, 'A', 83, 'C'),
(1530, 'B', 83, 'D'),
(1531, 'C', 83, 'D'),
(1532, 'D', 83, 'D'),
(1533, 'A', 84, 'B'),
(1534, 'B', 84, 'B'),
(1535, 'C', 84, 'C'),
(1536, 'D', 84, 'D'),
(1537, 'A', 85, 'B'),
(1538, 'B', 85, 'B'),
(1539, 'C', 85, 'D'),
(1540, 'D', 85, 'B'),
(1541, 'A', 86, 'D'),
(1542, 'B', 86, 'A'),
(1543, 'C', 86, 'B'),
(1544, 'D', 86, 'C'),
(1545, 'A', 87, 'B'),
(1546, 'B', 87, 'B'),
(1547, 'C', 87, 'D'),
(1548, 'D', 87, 'B'),
(1549, 'A', 88, 'A'),
(1550, 'B', 88, 'B'),
(1551, 'C', 88, 'C'),
(1552, 'D', 88, 'B'),
(1553, 'A', 89, 'C'),
(1554, 'B', 89, 'A'),
(1555, 'C', 89, 'C'),
(1556, 'D', 89, 'C'),
(1557, 'A', 90, 'D'),
(1558, 'B', 90, 'C'),
(1559, 'C', 90, 'C'),
(1560, 'D', 90, 'A'),
(1561, 'A', 91, 'A'),
(1562, 'B', 91, 'D'),
(1563, 'C', 91, 'A'),
(1564, 'D', 91, 'B'),
(1565, 'A', 92, 'D'),
(1566, 'B', 92, 'A'),
(1567, 'C', 92, 'A'),
(1568, 'D', 92, 'A'),
(1569, 'A', 93, 'A'),
(1570, 'B', 93, 'B'),
(1571, 'C', 93, 'B'),
(1572, 'D', 93, 'A'),
(1573, 'A', 94, 'B'),
(1574, 'B', 94, 'D'),
(1575, 'C', 94, 'A'),
(1576, 'D', 94, 'B'),
(1577, 'A', 95, 'C'),
(1578, 'B', 95, 'C'),
(1579, 'C', 95, 'C'),
(1580, 'D', 95, 'D'),
(1581, 'A', 96, 'C'),
(1582, 'B', 96, 'D'),
(1583, 'C', 96, 'B'),
(1584, 'D', 96, 'D'),
(1585, 'A', 97, 'D'),
(1586, 'B', 97, 'D'),
(1587, 'C', 97, 'B'),
(1588, 'D', 97, 'D'),
(1589, 'A', 98, 'D'),
(1590, 'B', 98, 'C'),
(1591, 'C', 98, 'B'),
(1592, 'D', 98, 'C'),
(1593, 'A', 99, 'B'),
(1594, 'B', 99, 'A'),
(1595, 'C', 99, 'B'),
(1596, 'D', 99, 'D'),
(1597, 'A', 100, 'B'),
(1598, 'B', 100, 'A'),
(1599, 'C', 100, 'B'),
(1600, 'D', 100, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `option1` text NOT NULL,
  `option2` text NOT NULL,
  `option3` text NOT NULL,
  `option4` text NOT NULL,
  `correct_answer` int(11) NOT NULL,
  `taglist_id` int(11) NOT NULL,
  `question_rating` float DEFAULT 0,
  `addedby` int(11) NOT NULL,
  `no_of_attempts` int(11) DEFAULT 1,
  `successful_attempts` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `option1`, `option2`, `option3`, `option4`, `correct_answer`, `taglist_id`, `question_rating`, `addedby`, `no_of_attempts`, `successful_attempts`) VALUES
(1, 'Great Andamanese, Onge, Jarawa and Sentinelese tribes belong to which of the following race?', '(a)	The Mongoloid', '(b)	The Negrito', '(c)	The Brachycephals', '(d)	The Proto-Australoid', 2, 28, 25.817, 1, 30, 21),
(2, 'Consider the following statements:\r\n1.	Painted Grey Ware (PGW) is an indication of the Harappa civilization.\r\n2.	The boghaz-Koi inscription found in Kazakhstan tells us about the Vedic culture.\r\n3.	Kushan coins show that they were Krishna devotees.\r\n4.	Arun Sonakia’s discovered the skull of the Narmada man.\r\nWhich of the statements given above is/are not correct?\r\n', '(a)	1 and 2 only', '(b)	1 only', '(c)	3 and 4 only', '(d)	All of the above are correct statements.', 1, 28, 0, 1, 9, 0),
(3, 'Consider the following statements about migration into India: \r\n1.	The Negritos from Africa were the last people to inhabit India.\r\n2.	The Brachycephals entered India from the east.\r\nWhich of the statements given above is/are not correct?\r\n', '(a)	1 only', '(b)	2 only', '(c)	Both 1 and 2', '(d)	Neither 1 nor 2', 3, 28, 70.9948, 1, 8, 3),
(4, 'Consider the following statements about foreigners in India: \r\n1.	The account of the Chinese traveller Hiuen Tsang tells us about the reign of Samudragupta.\r\n2.	Megasthanese came to India during the Mauryan reign.\r\nWhich of the statements given above is/are not correct?\r\n', '(a)	1 only', '(b)	2 only', '(c)	Both 1 and 2', '(d)	Neither 1 nor 2', 1, 28, 0, 1, 5, 0),
(5, 'Consider the following pairs: \r\nRace	Regions they are settled in \r\nNegritos	Andaman and Nicobar\r\nBrachycephals	South India\r\nMongoloids	Western India\r\nHow many pairs given above are correctly matched?\r\n', '(a)	No pair is matched', '(b)	Only one pair', '(c)	Only two pairs', '(d)	Only three pairs', 3, 28, 0, 1, 2, 1),
(6, 'Consider the following statements about the Stone Age:\r\n1.	The use of stone tools started about 2.5 million years ago with the arrival of modern humans (Homo Sapiens). \r\n2.	There is no evidence of tools other than stones during this period.\r\nWhich of the statements given above is/are correct?\r\n', '(a)	1 only', '(b)	2 only', '(c)	Both 1 and 2', '(d)	Neither 1 nor 2', 4, 29, 0, 1, 0, 0),
(7, 'The term Palaeolithic denotes ____.', '(a)	New stone age ', '(b)	Middle stone age ', '(c)	Old stone age ', '(d)	None of the above', 3, 29, 0, 1, 0, 0),
(8, 'Consider the following statements about the Lower Paleolithic Age:\r\n1.	The stone tools used were polished and small in size.\r\n2.	Humans were by then capable of making a small number of animal-like sounds.\r\nWhich of the statements given above is/are correct?\r\n', '(a)	1 only', '(b)	2 only', '(c)	Both 1 and 2', '(d)	Neither 1 nor 2', 2, 29, 0, 1, 0, 0),
(9, 'Choose the best correct option from the following choices about the Middle Palaeolithic Age –', 'a.	The Flake tool industry emerged during this age.', 'b.	Homo Sapiens and Homo Neanderthalensis appeared in the Middle Palaeolithic age.', 'c.	Both a and b are correct', 'd.	None of the options is correct', 3, 29, 0, 1, 0, 0),
(10, 'Choose the best correct option from the following choices about the Upper Palaeolithic Age –', 'a.	This age coincided with the early phase of the ice age.', 'b.	The idea of religion was still unknown in this age', 'c.	Both a and b are correct', 'd.	None of the options is correct', 4, 29, 0, 1, 0, 0),
(11, '9.	Consider the following pairs of Mesolithic Age locations: \r\nLocation	State\r\nAdamgarh	Uttar Pradesh\r\nBagor	Madhya Pradesh \r\nKharwar	Jammu and Kashmir\r\nSambalpur	Odisha\r\nHow many pairs given above are correctly matched?\r\n', 'Only one pair', 'Only two pairs', 'All three pairs', 'None of the three pairs are correctly matched', 1, 29, 0, 1, 0, 0),
(12, 'The term Chalcolithic denotes ____.', 'a.	Copper age', 'b.	New stone age ', 'c.	Middle stone age ', 'd.	Copper and stone age', 4, 30, 0, 1, 0, 0),
(13, 'Consider the following statements about the people of the Chalcolithic Age:\r\n1.	Cotton was not known to the Chalcolithic civilizations of India.\r\n2.	The pottery made was black and red pottery and ochre-coloured pottery.\r\nWhich of the statements given above is/are not correct?\r\n', 'a)	1 only', 'b)	2 only', 'c)	Both 1 and 2', 'd)	Neither 1 nor 2', 1, 30, 0, 1, 0, 0),
(14, 'Consider the following statements about the Chalcolithic age:\r\n1.	The Chalcolithic period started around 9000 years ago.\r\n2.	During this age, tools were made of metals only.\r\nWhich of the statements given above is/are correct?\r\n', '(a)	1 only', '(b)	2 only', '(c)	Both 1 and 2', '(d)	Neither 1 nor 2', 4, 30, 0, 1, 0, 0),
(15, 'Assertion (A) During the Chalcolithic age, the people lived in rural settlements with mud brick houses.\r\nReason (R): The discovery of earth goddess clay images in chalcolithic sites suggests some form of religion.\r\nIn the context of the above two statements, which one of the following is correct?\r\n', 'a.	Both A and R are true, but R is the correct explanation', 'b.	Both A and R are true, but R is not the correct explanation', 'c.	A is true, but R is false', 'd.	A is false, but R is true', 2, 30, 0, 1, 0, 0),
(16, 'Choose the best correct option from the following choices about the Chalcolithic age –', 'a.	Some terracotta female figurines have been found.', 'b.	The technique of crop rotation and the mixed economy was unknown to them.', 'c.	Both a. and b. options are correct', 'd.	None of the options is correct', 1, 30, 0, 1, 0, 0),
(17, 'Choose the best correct option. The people of the Chalcolithic age knew which of the following/s art of pottery –', 'a.	Hakra ware', 'b.	Ochre Colored Pottery.', 'c.	Black and red ware pottery', 'd.	Chalcolithic people knew about all three potteries.', 4, 30, 0, 1, 0, 0),
(18, 'Which one of the following ancient towns is well-known for its elaborate system of water harvesting and management by building a series of dams and channelizing water into connected reservoirs? [2021]', 'a)	Dholavira', 'b)	Kalibangan', 'c)	Rakhigarhi', 'd)	Ropar', 1, 31, 50.1717, 1, 2, 1),
(19, 'Which one of the following is not a Harappan Site? [2019]', '(a)	Chanhudaro ', '(b)	Kot Diji', '(c)	Sohagaura ', '(d)	Desalpur', 3, 31, 0, 1, 1, 1),
(20, 'Consider the following statements about the Harappan Civilisation:\r\n1.	Cemetary H Phase relates to the early Harappan phase.\r\n2.	During the Late Harappan, there was a rise in the pastoral mode of living.\r\nWhich of the statements given above is/are correct?\r\n', 'a)	1 only', 'b)	2 only', 'c)	Both 1 and 2', 'd)	Neither 1 nor 2', 2, 31, 0, 1, 1, 0),
(21, 'The term Mohenjo-Daro means ____.', 'a.	The mound of the dead', 'b.	The Granary Storage', 'c.	The dancing girl', 'd.	The Great Bath', 1, 31, 0, 1, 0, 0),
(22, 'Regarding the Indus Valley Civilization, consider the following statements:\r\n1.	It was predominantly a secular civilisation, and the religious element, though present, did not dominate the scene.\r\n2.	During this period, cotton was used for manufacturing textiles in India \r\nWhich of the statements given above is/are correct? [2011]\r\n', 'a)	1 only ', 'b)	2 only', 'c)	Both 1 and 2', 'd)	Neither 1 nor 2', 3, 32, 0, 1, 0, 0),
(23, 'Which one of the following animals was not represented in the seals and terracotta art of the Harappan culture?', 'Cow ', 'Elephant', 'Rhinoceros ', 'Tiger', 1, 32, 0, 1, 0, 0),
(24, 'Which of the following characterises/characterises the people of the Indus Civilisation? [2013]\r\n1.	They possessed great palaces and temples.\r\n2.	They worshipped both male and female deities.\r\n3.	They employed horse-drawn chariots in warfare.\r\nSelect the correct statement/statements using the codes given below.\r\n', '(a)	1 and 2 only', '(b)	2 only', '(c)	1, 2 and 3', '(d)	None of the statements given above is correct', 2, 32, 0, 1, 0, 0),
(25, 'Consider the following statements about the Harappan Civilisation:\r\n1.	There was often a provision of a street light at the roads’ crossings.\r\n2.	Houses were built in a radial pattern on either side of the roads.\r\nWhich of the statements given above is/are not correct?\r\n', 'a)	1 only', 'b)	2 only', 'c)	Both 1 and 2', 'd)	Neither 1 nor 2', 2, 32, 0, 1, 0, 0),
(26, 'Consider the following statements about the Harappan Civilisation:\r\n1.	In all the Harappan sites, the citadel and the lower town were situated in different complexes.\r\n2.	The lower town housed ordinary people and was generally situated in the east.\r\nWhich of the statements given above is/are not correct?\r\n', 'a)	1 only', 'b)	2 only', 'c)	Both 1 and 2', 'd)	Neither 1 nor 2', 1, 32, 0, 1, 0, 0),
(27, 'Consider the following statements about the Mohenjo-Daro site of the Harappan Civilisation:\r\n1.	Generally, a house had a drawing room, bedroom, kitchen, a spacious veranda, a bathroom and a well nearby.\r\n2.	Evidence of more than one-storied building has not been found.\r\nWhich of the statements given above is/are correct?\r\n', 'a)	1 only', 'b)	2 only', 'c)	Both 1 and 2', 'd)	Neither 1 nor 2', 1, 32, 0, 1, 0, 0),
(28, 'Which one of the following statements best reflects the Chief purpose of the ‘Constitution’ of a country? ', '(a)	It determines the objective for the making of necessary laws.', '(b)	It enables the creation of political offices and a government', '(c)	It defines and limits the powers of government.', '(d)	It secures social justice, social equality and social security.', 3, 42, 0, 1, 0, 0),
(29, 'Which one of the following best defines the term “State”?', '(a)	A community of persons permanently occupying a definite territory independent of external control and possessing an organized government.', '(b)	A politically organized people of a definite territory and possessing an authority to govern them, maintain law and order, protect their natural rights and safeguard their means of sustenance.', '(c)	A number of persons who have been living in a definite territory for a very long time with their own culture, tradition and government', '(d)	A society permanently living in a definite with a central authority, an executive responsible to the central authority and an independent judiciary.', 4, 42, 0, 1, 0, 0),
(30, 'A Nation can be best defined as?', '(a)	A political Entity which is sovereign in its domain', '(b)	A legal entity established by a constitution', '(c)	A cultural entity forged by sense of belongingness', '(d)	A Republican state with a welfare objective', 3, 42, 0, 1, 0, 0),
(31, 'Which of the following is not an essential element of a state?', '(a)	Population', '(b)	Sovereignty', '(c)	Constitution', '(d)	Government', 3, 42, 0, 1, 0, 0),
(32, 'Under Article 12 of the Constitution of India, which of the following constitute as an element of the Indian state?\r\n1.	Union Legislature\r\n2.	The Supreme court in judicial capacity\r\n3.	Public sector Undertakings\r\n4.	Panchayats\r\nHow many of the above options are correct?\r\n', 'a.	Only one', 'b.	Only two', 'c.	Only Three ', 'd.	All Four', 3, 42, 0, 1, 0, 0),
(33, 'By which one of the following Acts was the Governor General of Bengal designated as the Governor General of India? ', '(a)	The Regulating Act', '(b)	The Pitt’s India Act', '(c)	The Charter Act of 1793', '(d)	The Charter Act of 1833', 4, 43, 0, 1, 0, 0),
(34, 'The extra-ordinary bulk of the Constitution is due to \r\n1.	Incorporates the accumulated experience of a different constitution(s).\r\n2.	Detailed administrative provisions are included.\r\n3.	Both Justiciable and non-justiciable rights included Fundamental Rights, DPSPs, Fundamental Duties \r\n4.	More Rigid than flexible \r\nHow many of the above statements is/are correct?\r\n', '1.	only one ', '2.	only two ', '3.	only three', '4.	None of the above', 3, 46, 0, 1, 0, 0),
(35, 'Consider the following statements:\r\n1.	G. Austin described Indian Federalism as a \"Federation with a centralizing tendency\".\r\n2.	Morris Jones described Indian Federalism as \"Bargaining Federalism\".\r\n3.	Granville Austin described Indian Federalism as \"Co-operative Federalism\".\r\nHow many of the above statements is/are correct?\r\n', '1.	Only one', '2.	Only two', '3.	Only three', '4.	None', 2, 46, 0, 1, 0, 0),
(36, 'Which of the following emergency is mentioned in the Constitution\r\n1.	National Emergency\r\n2.	State Emergency\r\n3.	Disaster Emergency\r\n4.	Financial Emergency\r\nHow many of the above statements is/are correct?\r\n', '1.	Only one', '2.	Only two', '3.	Only three', '4.	All', 3, 46, 0, 1, 0, 0),
(37, 'The Constitution of India is', '(a)	Rigid', '(b)	Very rigid', '(c)	Flexible', '(d)	Partly rigid, partly flexible ', 4, 46, 0, 1, 0, 0),
(38, 'Which of the following countries enjoys a federal form of government?\r\n1.	China\r\n2.	USA \r\n3.	Cuba\r\n4.	Belgium\r\nHow many of the above statements is/are correct?\r\n', '1.	Only one', '2.	Only two', '3.	Only three', '4.	All', 1, 46, 0, 1, 0, 0),
(39, 'The features of parliamentary government in India are: \r\n1.	Presence of real and nominal executives; \r\n2.	Majority party rule, \r\n3.	Collective responsibility of the executive to the legislature\r\n4.	Parliament\'s sovereignty\r\nHow many of the above statements is/are correct?\r\n', '1.	Only one', '2.	Only two', '3.	Only three', '4.	All', 4, 46, 0, 1, 0, 0),
(40, 'Consider the following statements about \'the Charter Act of 1813\': [2019]\r\n1.	It ended the trade monopoly of the East India Company in India except for trade in tea and trade with China.\r\n2.	It asserted the sovereignty of the British Crown over the Indian territories held by the Company.\r\n3.	The revenues of India were now controlled by the British Parliament. \r\nWhich of the statements given above are correct?\r\n', '(a)	1 and 2 only', '(b)	2 and 3 only', '(c)	1 and 3 only', '(d)	1, 2 and 3', 1, 43, 0, 1, 0, 0),
(41, 'Which of the following led to the introduction of English Education in India? \r\n1.	Charter Act of 1813\r\n2.	General Committee of Public Instruction, 1823\r\n3.	Orientalist and Anglicist Controversy \r\nSelect the correct answer using the code given below\r\n', '(a)	1 and 2 only ', '(b)	2 only', '(c)	1 and 3 only', '(d)	1, 2 and 3', 4, 43, 0, 1, 0, 0),
(42, 'Consider the following statements:\r\n1.	The Charter Act, 1853 abolished East India Company monopoly of Indian trade.\r\n2.	Under the Government of India Act, 1858 the British Parliament abolished the rule of East India Company and undertook the responsibility of ruling India directly.\r\n Which of the statement(s) given above is/are correct? \r\n', '(a)	1 only', '(b)	2 only', '(c)	Both 1 and 2', '(d)	Neither 1 nor 2', 2, 43, 0, 1, 0, 0),
(43, 'By a regulation in 1793, the District Collector was deprived of his judicial powers and made the collecting agent only. What was the reason for such a regulation? ', '(a)	Lord Cornwallis felt that the District Collector\'s efficiency of revenue collection would enormously increase without the burden of additional work.', '(b)	Lord Cornwallis felt that judicial power should compulsorily be in the hands of Europeans while Indians can be given the job of revenue collection in the districts.', '(c)	Lord Cornwallis was alarmed at the extent of power concentrated in the District Collector and felt that such absolute power was undesirable in one person.', '(d)	The judicial work demanded a deep knowledge of India and a good training in law and Lord Cornwallis felt that District Collector should be only a revenue collector.', 3, 43, 0, 1, 0, 0),
(44, 'Which one of the following pairs is not correctly matched?', '(a)	Pitt’s India Act - Warren Hastings', '(b)	Doctrine of Lapse - Dalhousie', '(c)	Vernacular Press Act - Curzon', '(d)	Ilbert Bill – Ripon', 3, 44, 0, 1, 0, 0),
(45, 'In the federation established by The Government on India Act of 1935. Residuary Power were given to the ', '(a)	Federal Legislature', '(b)	Governor General', '(c)	Provincial Legislature', '(d)	Provincial Governors', 2, 44, 0, 1, 0, 0),
(46, 'The Montague-Chelmsford Proposals were related to', '(a)	social reforms', '(b)	educational reforms', '(c)	reforms in police administration', '(d)	constitutional reforms', 4, 44, 0, 1, 0, 0),
(47, 'The Government of India Act of 1919 clearly defined', '(a)	the separation of power between the judiciary and the legislature', '(b)	the jurisdiction of the central and provincial governments', '(c)	the powers of the Secretary of State for India and the Viceroy', '(d)	None of the above', 2, 44, 0, 1, 0, 0),
(48, 'What was/were the object/objects of Queen Victoria’s Proclamation (1858)? \r\n1.	To disclaim any intention to annex Indian States.\r\n2.	To place the Indian administration under the British Crown.\r\n3.	To regulate East India Company’s trade with India.\r\n Select the correct answer using the code given below.\r\n', '(a)	1 and 2 only ', '(b)	2 only', '(c)	1 and 3 only', '(d)	1, 2 and 3', 1, 44, 0, 1, 0, 0),
(49, 'Which of the following countries plays an important role in the constitution for the customary law? ', '(a)	The Constitution of the United States', '(b)	The French Constitution', '(c)	Constitution of India', '(d)	British Constitution', 4, 47, 0, 1, 0, 0),
(50, 'Which of the following pairs are correctly matched? \r\n1.	British Constitution: Federal Scheme\r\n2.	Government of India Act of 1935: Emergency provisions and administrative details.\r\n3.	Canadian Constitution: Concurrent List\r\n4.	South African Constitution: Procedure for amendment of the Constitution\r\nSelect the correct answer using the codes given below\r\n', 'a.	1, 2, 3 and 4 ', 'b.	2 and 4', 'c.	1, 2 and 4 ', 'd.	1 and 4', 2, 47, 0, 1, 0, 0),
(51, 'Following which country the Article 368 of the Indian Constitution is designed?', '(a)	U.K.', '(b)	U.S. A', '(c)	South Africa', '(d)	Ireland', 3, 47, 0, 1, 0, 0),
(52, 'The concept of Lokpal in the Indian Constitution is derived from the Constitution of which country?', '(a)	Switzerland', '(b)	Canada', '(c)	Sweden', '(d)	Germany', 3, 47, 0, 1, 0, 0),
(53, 'The concept of the Preamble, has been adopted in the Constitution of India from which country ?', '(a)	Canada', '(b)	UK', '(c)	Sweden', '(d)	United States', 4, 47, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `submission_counter`
--

CREATE TABLE `submission_counter` (
  `id` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submission_counter`
--

INSERT INTO `submission_counter` (`id`, `count`) VALUES
(1, 2339);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `parentTagName` varchar(255) DEFAULT NULL,
  `tagName` varchar(255) DEFAULT NULL,
  `addedBy` varchar(255) DEFAULT NULL,
  `parentTagId` int(11) DEFAULT NULL,
  `updatedBy` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `updatedTime` time DEFAULT NULL,
  `ismastertag` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `parentTagName`, `tagName`, `addedBy`, `parentTagId`, `updatedBy`, `status`, `updatedTime`, `ismastertag`) VALUES
(1, 'UPSC CSE', 'General Studies 1', '1', 1, '1', 1, '00:20:24', 0),
(2, 'UPSC CSE', 'General Studies 2', '1', 1, '1', 1, '00:20:24', 0),
(3, 'UPSC CSE', 'General Studies 3', '1', 1, '1', 1, '00:20:24', 0),
(4, 'UPSC CSE', 'General Studies 4', '1', 1, '1', 1, '00:20:24', 0),
(5, 'UPSC CSE', 'CSAT', '1', 1, '1', 1, '00:20:24', 0),
(6, 'General Studies 1', 'History', '1', 1, '1', 1, '00:20:24', 0),
(7, 'General Studies 1', 'Society', '1', 1, '1', 1, '00:20:24', 0),
(8, 'General Studies 1', 'Geography', '1', 1, '1', 1, '00:20:24', 0),
(9, 'General Studies 2', 'Indian Polity', '1', 2, '1', 1, '00:20:24', 0),
(11, 'General Studies 2', 'Governance', '1', 2, '1', 1, '00:20:24', 0),
(12, 'General Studies 2', 'International Relations', '1', 2, '1', 1, '00:20:24', 0),
(14, 'General Studies 3', 'Indian Economy', '1', 3, '1', 1, '00:20:24', 0),
(15, 'General Studies 3', 'Agriculture', '1', 3, '1', 1, '00:20:24', 0),
(16, 'General Studies 3', 'Science & Technology', '1', 3, '1', 1, '00:20:24', 0),
(17, 'General Studies 3', 'Environment & DM', '1', 3, '1', 1, '00:20:24', 0),
(18, 'General Studies 3', 'Internal Security', '1', 3, '1', 1, '00:20:24', 0),
(19, 'History', 'Ancient India', '1', 6, '1', 1, '00:20:24', 0),
(20, 'History', 'Medieval India', '1', 6, '1', 1, '00:20:24', 0),
(24, 'History', 'Modern India', '1', 6, '1', 1, '00:20:24', 0),
(25, 'History', 'World History', '1', 6, '1', 1, '00:20:24', 0),
(26, 'History', 'Contemporary India', '1', 6, '1', 1, '00:20:24', 0),
(27, 'General Studies 1', 'Art and Culture', '1', 1, '1', 1, '00:20:24', 0),
(28, 'Ancient India', 'What is History', '1', 19, '1', 1, '00:20:24', 0),
(29, 'Ancient India', 'Stone Age', '1', 19, '1', 1, '00:20:24', 0),
(30, 'Ancient India', 'Chalcolithic Age', '1', 19, '1', 1, '00:20:24', 0),
(31, 'Ancient India', 'Harappan Civilisation', '1', 19, '1', 1, '00:20:24', 0),
(32, '', 'Various Aspects of Harappan civilisation', '1', 0, '1', 1, '00:20:24', 0),
(33, 'Ancient India', 'Decline of Harappan Civilisation', '1', 19, '1', 1, '00:20:24', 0),
(34, 'Indian Polity', 'Indian Constitution', '1', 9, '1', 1, '00:20:24', 0),
(35, 'Indian Polity', 'Legislature', '1', 9, '1', 1, '00:20:24', 0),
(36, 'Indian Polity', 'Executive', '1', 9, '1', 1, '00:20:24', 0),
(37, 'Indian Polity', 'Judiciary', '1', 9, '1', 1, '00:20:24', 0),
(38, 'Indian Polity', 'Local Government', '1', 9, '1', 1, '00:20:24', 0),
(39, 'Indian Polity', 'Constitutional Bodies', '1', 9, '1', 1, '00:20:24', 0),
(40, 'Indian Polity', 'Elections in India', '1', 9, '1', 1, '00:20:24', 0),
(41, 'Indian Polity', 'Statutory & Non-Statutory Bodies', '1', 9, '1', 1, '00:20:24', 0),
(42, 'Indian Constitution', 'What is Constitution?', '1', 34, '1', 1, '00:20:24', 0),
(43, 'Indian Constitution', 'Evolution of Indian Constitution', '1', 34, '1', 1, '00:20:24', 0),
(44, 'Indian Constitution', 'Crown Rule', '1', 34, '1', 1, '00:20:24', 0),
(45, 'Indian Constitution', 'Making of Indian constitution', '1', 34, '1', 1, '00:20:24', 0),
(46, 'Indian Constitution', 'Salient Features of Indian Constitution', '1', 34, '1', 1, '00:20:24', 0),
(47, 'Indian Constitution', 'Sources of Indian constitution', '1', 34, '1', 1, '00:20:24', 0),
(48, 'Indian Constitution', 'Preamble of Indian Constitution', '1', 34, '1', 1, '00:20:24', 0),
(49, 'Indian Constitution', 'Union & its Territory', '1', 34, '1', 1, '00:20:24', 0),
(50, 'Indian Constitution', 'Citizenship', '1', 34, '1', 1, '00:20:24', 0),
(51, 'Indian Constitution', 'Fundamental Rights', '1', 34, '1', 1, '00:20:24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `upsc_prelims`
--

CREATE TABLE `upsc_prelims` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `roll_number` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cleared` varchar(3) NOT NULL,
  `cutoff_estimate` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `upsc_prelims`
--

INSERT INTO `upsc_prelims` (`id`, `year`, `roll_number`, `score`, `name`, `email`, `cleared`, `cutoff_estimate`) VALUES
(1, 2025, '0123456', 132, 'Ajay Upadhyay', 'ajayupadhyay@99notes.in', '', 0),
(2, 2024, '0123456', 135, 'Ajay Upadhyay', 'ajayupadhyay@99notes.in', '', 0),
(3, 2026, '0123457', 142, 'ramfal', 'ramfal@99notes.in', '', 0),
(4, 2024, '0123455', 160, 'pulakit', 'pulakit@99notes.in', '', 0),
(5, 2024, '465890', 145, NULL, NULL, '', 0),
(6, 2025, '0123456', 150, 'Ajay Upadhyay', 'ajayupadhyay@99notes.in', '', 0),
(7, 2024, '0123456', 132, 'Ajay Upadhyay', 'ajayupadhyay@99notes.in', '', 0),
(8, 2025, '0123499', 140, 'ravinder', 'ravinder@gmail.com', '', 0),
(9, 2024, '0123451', 120, 'Ajay Upadhyay', 'ajayupadhyay@99notes.in', '', 0),
(10, 2025, 'sunny', 144, 'sunny', 'sunny@gmail.com', '', 0),
(11, 2025, 'sunny', 144, 'sunny', 'sunny@gmail.com', '', 0),
(12, 2025, 'sunny', 144, 'sunny', 'sunny@gmail.com', '', 0),
(13, 2024, '267556', 147, 'Facebook 99notes', 'admin@gmail.com', '', 0),
(14, 2024, '0123456', 145, 'Ajay Upadhyay', 'ajayupadhyay@99notes.in', '', 0),
(15, 2025, '0123456', 178, 'Ajay Upadhyay', 'ajayupadhyay@99notes.in', '', 0),
(16, 2025, '0123456', 178, 'Ajay Upadhyay', 'ajayupadhyay@99notes.in', '', 0),
(17, 2024, '0123459', 156, NULL, NULL, '', 0),
(18, 2024, '456789', 177, 'jaisu', 'jaisu@99notes.in', '', 0),
(19, 2024, '456789', 177, NULL, NULL, '', 0),
(20, 2025, '0123457', 198, 'ramfal', 'ramfal@99notes.in', '', 0),
(21, 2025, '0123457', 198, 'ramfal', 'ramfal@99notes.in', '', 0),
(22, 2024, '998877', 30, 'chandrasekhar', 'chandrasekhar@gmail.com', '', 0),
(23, 2024, '223344', 20, 'pulakit', 'pulakit@gmail.com', '', 0),
(24, 2024, '223340', 0, 'dheeraj', 'dheeraj@gmail.com', '', 0),
(25, 2024, '0123456', 200, 'Ajay Upadhyay', 'ajayupadhyay@99notes.in', '', 0),
(26, 2024, '0123456', 140, 'Ajay Upadhyay', 'ajayupadhyay@99notes.in', '', 0),
(27, 2024, '0123456', 140, 'Ajay Upadhyay', 'ajayupadhyay@99notes.in', '', 0),
(28, 2024, '200300', 150, '99notes', 'tech.99notes@gmail.com', '', 0),
(29, 2024, '123456', 200, 'Ajay Upadhyay', 'ajayupadhyay@99notes.in', 'yes', 150),
(30, 2024, '2456789', 166, 'Ajay Upadhyay', 'ajayupadhyay030@gmail.com', 'yes', 200);

-- --------------------------------------------------------

--
-- Table structure for table `UserResponses`
--

CREATE TABLE `UserResponses` (
  `response_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `set_id` varchar(5) NOT NULL,
  `question_number` int(11) NOT NULL,
  `selected_answer` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `globalRating` float DEFAULT NULL,
  `tagwiseRating` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tagwiseRating`)),
  `addedBy` int(11) DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `category` varchar(50) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `history_rating` float DEFAULT 0,
  `society_rating` float DEFAULT 0,
  `geography_rating` float DEFAULT 0,
  `polity_rating` float DEFAULT 0,
  `governance_rating` float DEFAULT 0,
  `international_relations_rating` float DEFAULT 0,
  `economy_rating` float DEFAULT 0,
  `agriculture_rating` float DEFAULT 0,
  `science_tech_rating` float DEFAULT 0,
  `environment_dm_rating` float DEFAULT 0,
  `internal_security_rating` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `phone`, `password`, `gender`, `globalRating`, `tagwiseRating`, `addedBy`, `updatedBy`, `status`, `category`, `createdAt`, `updatedAt`, `history_rating`, `society_rating`, `geography_rating`, `polity_rating`, `governance_rating`, `international_relations_rating`, `economy_rating`, `agriculture_rating`, `science_tech_rating`, `environment_dm_rating`, `internal_security_rating`) VALUES
(1, 'Ajay', 'upadhyay', 'ajayupadhyay@99notes.in', '9354316007', '$2y$10$qGBk7laR87NFyfZSVjEHjesuOJ3evOEb97.w2H1eWTBf77ko4CMQy', 'Male', 91.2587, NULL, NULL, NULL, 'active', NULL, '2024-06-27 08:58:21', '2024-07-21 17:01:32', 2.00639, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 'sonal', 'Yadav', 'sonal.yadav@99notes.in', '9354138347', '$2y$10$v4wyRqwO0E445bU76pc9XOF/CH.fHiDla8mbQyfOTPOjq54a19Su6', 'Female', 0, NULL, NULL, NULL, 'active', NULL, '2024-06-29 06:32:52', '2024-06-29 06:32:52', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `average_score`
--
ALTER TABLE `average_score`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_tags`
--
ALTER TABLE `master_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pre_questions`
--
ALTER TABLE `pre_questions`
  ADD PRIMARY KEY (`question_id`),
  ADD UNIQUE KEY `set_id` (`set_id`,`question_number`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taglist_id` (`taglist_id`),
  ADD KEY `addedby` (`addedby`);

--
-- Indexes for table `submission_counter`
--
ALTER TABLE `submission_counter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upsc_prelims`
--
ALTER TABLE `upsc_prelims`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `UserResponses`
--
ALTER TABLE `UserResponses`
  ADD PRIMARY KEY (`response_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `set_id` (`set_id`,`question_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `average_score`
--
ALTER TABLE `average_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `master_tags`
--
ALTER TABLE `master_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pre_questions`
--
ALTER TABLE `pre_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1601;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `submission_counter`
--
ALTER TABLE `submission_counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `upsc_prelims`
--
ALTER TABLE `upsc_prelims`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `UserResponses`
--
ALTER TABLE `UserResponses`
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `UserResponses`
--
ALTER TABLE `UserResponses`
  ADD CONSTRAINT `userresponses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`),
  ADD CONSTRAINT `userresponses_ibfk_2` FOREIGN KEY (`set_id`,`question_number`) REFERENCES `pre_questions` (`set_id`, `question_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
