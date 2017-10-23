CREATE TABLE Code
(
    `code`         VARCHAR(15)    NOT NULL     COMMENT '코드',
    `desc`         VARCHAR(45)    NOT NULL     COMMENT '설명',
    `parent_code`  VARCHAR(15)    NULL         COMMENT '부모 코드',
    `sequence`     INT            NULL         COMMENT '순서',
    PRIMARY KEY (code)
);

ALTER TABLE Code COMMENT '코드 관리';

CREATE INDEX Code_Index_1 ON Code
(
    code, parent_code
);
