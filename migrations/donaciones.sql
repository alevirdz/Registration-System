
CREATE TABLE `donaciones` (
  `id` int(250) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `donacion` varchar(255) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `donaciones`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `donaciones`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;
COMMIT;
