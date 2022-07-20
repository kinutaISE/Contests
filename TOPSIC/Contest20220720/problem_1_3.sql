SELECT
    IM.PORT_CODE AS "港コード",
    P.PORT_NAME AS "港名",
    (
        SELECT
            AMT
        FROM
            IMMIGRATION
        WHERE
            PORT_CODE = IM.PORT_CODE
        AND KIND_CODE = "110"
    ) AS "入国者数",
    (
        SELECT
            AMT
        FROM
            IMMIGRATION
        WHERE
            PORT_CODE = IM.PORT_CODE
        AND KIND_CODE = "120"
    ) AS "出国者数",
    (
        SELECT
            AMT
        FROM
            IMMIGRATION
        WHERE
            PORT_CODE = IM.PORT_CODE
        AND KIND_CODE = "110"
    ) - (
        SELECT
            AMT
        FROM
            IMMIGRATION
        WHERE
            PORT_CODE = IM.PORT_CODE
        AND KIND_CODE = "120"
    ) AS "差分"
FROM
    IMMIGRATION AS IM
        INNER JOIN PORT AS P ON IM.PORT_CODE = P.PORT_CODE
        INNER JOIN GRP AS G ON IM.GROUP_CODE = G.GROUP_CODE
WHERE
    G.GROUP_NAME = "外国人"
GROUP BY
    IM.PORT_CODE
HAVING
    "入国者数" > "出国者数"
ORDER BY
    "差分" DESC,
    "港コード" DESC ;