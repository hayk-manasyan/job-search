-- Since 2018-01-29
UPDATE `jobs` SET `job_source` = 0 WHERE `job_source` = 'Github';
UPDATE `jobs` SET `job_source` = 1 WHERE `job_source` = 'StackOverflow';

ALTER TABLE `jobs` CHANGE `job_source` `job_source` TINYINT(4) NULL DEFAULT NULL;

-- Since 2019-01-12
CREATE INDEX desc_en_idx ON jobs USING GIN (to_tsvector('english', description));