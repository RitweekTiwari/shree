SELECT ts.order_barcode, ts.stat,op.order_id ,
COUNT(op.order_product_id),
(
    SELECT
        COUNT(*) AS cancel
    FROM
        order_product AS c
    WHERE
        c.order_id = op.order_id AND c.status = 'CANCEL'
) AS cancel,
(
    SELECT
        COUNT(*) AS cancel
    FROM
        order_product AS c
    WHERE
        c.order_id = op.order_id AND c.status = 'DONE'
) AS done,
(
    SELECT
        COUNT(*) AS cancel
    FROM
        order_product AS c
    WHERE
        c.order_id = op.order_id AND c.status = 'PENDING'
) AS pending,
(
    SELECT
        COUNT(*) AS cancel
    FROM
        order_product AS c
    WHERE
        c.order_id = op.order_id AND c.status = 'OUT'
) AS pglist,
(SELECT CONCAT( sub_department.sortname, ",", COUNT(ts.order_barcode) ) 
FROM transaction INNER JOIN sub_department on sub_department.id=transaction.to_godown
WHERE transaction.transaction_id = ts.transaction_id
GROUP BY transaction.to_godown

) AS godown
FROM transaction_meta as ts  RIGHT JOIN order_product as op on op.order_barcode=ts.order_barcode
WHERE ts.stat != 'out'
GROUP BY op.order_id


SELECT transaction_meta.order_barcode, CONCAT( "name", sub_department.sortname, "total", COUNT(transaction_meta.order_barcode) ) FROM transaction_meta join transaction on transaction_meta.transaction_id=transaction.transaction_id
JOIN sub_department on sub_department.id=transaction.to_godown
GROUP BY transaction.transaction_id, transaction.to_godown