CREATE TABLE Code
(
    `code`         VARCHAR(15)    NOT NULL     COMMENT '코드',
    `code_ko`      VARCHAR(45)    NULL         COMMENT '코드 한글',
    `desc`         VARCHAR(45)    NULL         COMMENT '설명',
    `parent_code`  VARCHAR(15)    NULL         COMMENT '부모 코드',
    `sequence`     INT            NULL         COMMENT '순서',
    PRIMARY KEY (code, parent_code)
);

ALTER TABLE Code COMMENT '코드 관리';

CREATE INDEX Code_Index_1 ON Code
(
    code, parent_code, code_ko
);
