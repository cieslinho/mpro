<?php
defined('ABSPATH') || exit;
?>

<section class="checkout">
    <div class="container">
        <div class="checkout__form">
            <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
                <div class="checkout__boxes">
                    <div class="checkout__details" id="customer_details">
                        <?php do_action('woocommerce_checkout_billing'); ?>
                        <?php do_action('woocommerce_checkout_shipping'); ?>
                    </div>
                    
                    <div class="checkout__summary">
                        <h2 class="checkout__summary-title"><?php esc_html_e('Your order', 'woocommerce'); ?></h2>
                        <?php do_action('woocommerce_checkout_before_order_review'); ?>
                        <div id="order_review" class="checkout__order-review">
                            <?php do_action('woocommerce_checkout_order_review'); ?>
                        </div>
                        <?php do_action('woocommerce_checkout_after_order_review'); ?>
                        <?php if (wc_coupons_enabled()) : ?>
                            <div class="checkout__coupon">
                                <h3 class="checkout__coupon-title"><?php esc_html_e('Have a coupon?', 'woocommerce'); ?></h3>
                                <form class="checkout__coupon-form" action="<?php echo esc_url(wc_get_checkout_url()); ?>" method="post">
                                    <div class="checkout__coupon-input">
                                        <input type="text" name="coupon_code" id="coupon_code" class="input-text" placeholder="<?php esc_html_e('Wprowadź kod rabatowy', 'woocommerce'); ?>" value="" />
                                    </div>
                                    <div class="checkout__coupon-action">
                                        <button type="submit" class="button checkout__coupon-btn" name="apply_coupon" value="<?php esc_attr_e('zastosuj', 'woocommerce'); ?>"><?php esc_html_e('zastosuj', 'woocommerce'); ?></button>
                                        <?php do_action('woocommerce_checkout_coupon'); ?>
                                    </div>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
        <?php do_action('woocommerce_after_checkout_form', $checkout); ?>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
	const purchaseTypeRadioButtons = document.querySelectorAll('input[name="purchase_type"]')
	const shipToDifferentAddressCheckbox = document.querySelector('input[name="ship_to_different_address"]')

	const fields = {
		companyField: document.getElementById('billing_company_field'),
		nipField: document.getElementById('billing_nip_field'),
		shippingCompanyField: document.getElementById('shipping_company_field'),
		shippingNipField: document.getElementById('shipping_nip_field'),
		shippingFirstNameField: document.getElementById('shipping_first_name_field'),
		shippingLastNameField: document.getElementById('shipping_last_name_field'),
	}

	function toggleFields() {
		const isPrivatePurchase = document.querySelector('input[name="purchase_type"]:checked')?.value === 'private'
		const isBusinessPurchase = document.querySelector('input[name="purchase_type"]:checked')?.value === 'business'
		const isShipToDifferent = shipToDifferentAddressCheckbox.checked

		const displayStyle = condition => (condition ? 'block' : 'none')

		// Pole "Nazwa firmy" i "NIP" pojawia się tylko, gdy zakup na firmę
		fields.companyField.style.display = displayStyle(isBusinessPurchase)
		fields.nipField.style.display = displayStyle(isBusinessPurchase)

		// Pole "Nazwa firmy" w wysyłce pojawia się tylko, gdy zakup na firmę, niezależnie od wysyłki
		fields.shippingCompanyField.style.display = displayStyle(isBusinessPurchase && isShipToDifferent)

		// Pola wysyłki pojawiają się tylko wtedy, gdy "wysyłka na inny adres" jest zaznaczone
		fields.shippingFirstNameField.style.display = displayStyle(isShipToDifferent)
		fields.shippingLastNameField.style.display = displayStyle(isShipToDifferent)
	}

	function updateNipLabel() {
		const isBusiness = document.querySelector('input[name="purchase_type"]:checked')?.value === 'business'
		const nipLabel = document.querySelector('label[for="billing_nip"]')
		const nipField = document.getElementById('billing_nip')

		if (nipLabel) {
			nipLabel.innerHTML = isBusiness
				? 'NIP <span class="required">*</span>'
				: 'NIP <span class="optional">(opcjonalne)</span>'
		}

		if (nipField) {
			nipField.required = isBusiness
		}
	}

	function updateCompanyField() {
		const isBusiness = document.querySelector('input[name="purchase_type"]:checked')?.value === 'business'
		const companyLabel = document.querySelector('label[for="billing_company"]')
		const companyField = document.getElementById('billing_company')

		if (companyLabel) {
			companyLabel.innerHTML = isBusiness
				? 'Nazwa firmy <span class="required">*</span>'
				: 'Nazwa firmy <span class="optional">(opcjonalne)</span>'
		}

		if (companyField) {
			companyField.required = isBusiness
		}
	}

	// Nasłuchujemy zmian w radiobuttonach "Zakup prywatny / na firmę"
	purchaseTypeRadioButtons.forEach(button => {
		button.addEventListener('change', function () {
			toggleFields() // Zmieniamy widoczność pól
			updateNipLabel() // Uaktualniamy etykiety
			updateCompanyField()
		})
	})

	// Nasłuchujemy zmian w checkboxie "Wysyłka na inny adres"
	if (shipToDifferentAddressCheckbox) {
		shipToDifferentAddressCheckbox.addEventListener('change', toggleFields)
	}

	// Ustawiamy początkowy stan pól na podstawie aktualnych opcji
	function init() {
		toggleFields()
		updateNipLabel()
		updateCompanyField()
	}

	// Wywołanie początkowe, aby ustawić stan pól na załadowanie strony
	init()
})

</script>