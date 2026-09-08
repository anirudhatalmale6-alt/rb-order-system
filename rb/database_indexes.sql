-- ============================================================================
--  The Royal Bakery - performance indexes
--  Run ONCE against the trbsysne2_royal database (phpMyAdmin > SQL tab).
--
--  Every table in this database currently has ONLY its PRIMARY KEY. Every
--  lookup by invoice number, mobile number, date or product therefore scans
--  the whole table - 173,000 invoices, 357,000 order lines, 153,000 customers
--  on every single query. That is the main reason the system is slow.
--
--  These indexes are safe to run on the live database: they add no columns,
--  change no data, and can be dropped again at any time. Expect the statement
--  to take a couple of minutes on the order/invoice tables.
-- ============================================================================

-- --- rox_invoice: joined by rox_inv_auto_id, filtered by date and status ---
ALTER TABLE rox_invoice
    ADD INDEX idx_inv_auto_id   (rox_inv_auto_id),
    ADD INDEX idx_inv_date      (rox_inv_date),
    ADD INDEX idx_inv_status    (rox_inv_status),
    ADD INDEX idx_inv_cus       (rox_inv_cus_id),
    ADD INDEX idx_inv_del_date  (rox_del_date),
    ADD INDEX idx_inv_by        (rox_inv_by),
    ADD INDEX idx_inv_date_stat (rox_inv_date, rox_inv_status);

-- --- rox_order_info: the biggest table, always looked up by invoice ---
ALTER TABLE rox_order_info
    ADD INDEX idx_oi_inv        (rox_inv_id),
    ADD INDEX idx_oi_status     (rox_ord_status),
    ADD INDEX idx_oi_date       (ord_date),
    ADD INDEX idx_oi_prd_val    (rox_prd_val),
    ADD INDEX idx_oi_inv_status (rox_inv_id, rox_ord_status),
    ADD INDEX idx_oi_prd_date   (rox_prd_val, ord_date);

-- --- rox_payment ---
ALTER TABLE rox_payment
    ADD INDEX idx_pay_inv       (rox_inv_id),
    ADD INDEX idx_pay_cust      (rox_cust_id),
    ADD INDEX idx_pay_date      (rox_pay_date),
    ADD INDEX idx_pay_type      (rox_pay_typ),
    ADD INDEX idx_pay_date_type (rox_pay_date, rox_pay_typ);

-- --- rox_balance_payment ---
ALTER TABLE rox_balance_payment
    ADD INDEX idx_bp_inv        (rox_inv_id),
    ADD INDEX idx_bp_cust       (rox_cust_id),
    ADD INDEX idx_bp_date       (rox_pay_date);

-- --- rox_customers: searched by mobile on every order ---
ALTER TABLE rox_customers
    ADD INDEX idx_cus_mobile    (cus_mobile),
    ADD INDEX idx_cus_land      (cus_land),
    ADD INDEX idx_cus_fname     (cus_fname),
    ADD INDEX idx_cus_joined    (joined_date);

-- --- rox_product / categories: used to build the Add Order dropdowns ---
ALTER TABLE rox_product
    ADD INDEX idx_prd_main      (rox_prd_main_cate),
    ADD INDEX idx_prd_sub       (rox_prd_sub_cate),
    ADD INDEX idx_prd_main_sub  (rox_prd_main_cate, rox_prd_sub_cate);

ALTER TABLE rox_acc_sub_cate
    ADD INDEX idx_sub_main      (rox_main_cate_id);

-- --- rox_cancel_orders ---
ALTER TABLE rox_cancel_orders
    ADD INDEX idx_can_inv       (rox_inv_id);

-- --- login lookup ---
ALTER TABLE rox_admin_user
    ADD INDEX idx_admin_user    (rox_user_name);
