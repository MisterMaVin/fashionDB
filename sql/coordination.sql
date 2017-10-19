CREATE TABLE Coordination
(
    `codi_no`  INT    NOT NULL    AUTO_INCREMENT COMMENT '코디 번호',
    `top`      INT    NOT NULL     COMMENT '상의',
    `bottom`   INT    NOT NULL     COMMENT '하의',
    `outer`    INT    NULL         COMMENT '아우터',
    `shoes`    INT    NULL         COMMENT '신발',
    PRIMARY KEY (codi_no)
);

ALTER TABLE Coordination COMMENT '코디';

CREATE INDEX Coordination_Index_1 ON Coordination
(
    top, bottom
);
