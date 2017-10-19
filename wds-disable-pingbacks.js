jQuery( document ).ready( function( $ ) {
	var $defaultPingStatus = $( '#default_ping_status' );
	$defaultPingStatus.prop( 'checked', false );
	$defaultPingStatus.prop( 'disabled', 'disabled' );
	$( 'label[for="default_ping_status"]' ).next().after( '<p class="description">' + wds_disable_pingbacks.disabled_message + '</p><br/>' );
} );
