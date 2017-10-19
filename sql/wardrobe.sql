CREATE TABLE Wardrobe
(
    `cloth_no`        INT             NOT NULL    AUTO_INCREMENT COMMENT '옷 번호',
    `cloth_name`      VARCHAR(45)     NULL         COMMENT '품명',
    `category`        VARCHAR(45)     NULL         COMMENT '상의/하의/아우터 등의 분류',
    `color`           VARCHAR(45)     NULL         COMMENT '색상',
    `size`            VARCHAR(45)     NULL         COMMENT '사이즈',
    `usage`           VARCHAR(45)     NULL         COMMENT '용도',
    `brand`           VARCHAR(45)     NULL         COMMENT '브랜드',
    `photo_location`  VARCHAR(100)    NULL         COMMENT '사진 주소',
    `note`            TEXT            NULL         COMMENT '비고',
    PRIMARY KEY (cloth_no)
);

ALTER TABLE Wardrobe COMMENT '옷장';

CREATE INDEX Wardrobe_Index_1 ON Wardrobe
(
    cloth_name, category, color
);
