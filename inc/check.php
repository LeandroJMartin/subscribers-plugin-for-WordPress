<?php

class asswp_check_assi_subscribers {

	static $instance = false;

	public static function get_instance() {

		if( ! self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	private function __construct() {
        
        if(!empty($_POST['asswp_submit'])){
     
            $asswpData    = date('Y-m-d H:i:s');
            $asswp_nome   = filter_input(INPUT_POST, 'asswp_nome', FILTER_SANITIZE_STRING );        
            $asswp_email  = filter_input(INPUT_POST, 'asswp_email', FILTER_SANITIZE_EMAIL );
            $asswpTel     = filter_input(INPUT_POST, 'asswp_fone', FILTER_SANITIZE_STRING );
            $asswpAssunto = filter_input(INPUT_POST, 'asswp_assunto', FILTER_SANITIZE_STRING );
            $asswpMsg     = filter_input(INPUT_POST, 'asswp_msg', FILTER_SANITIZE_STRING );
            
            $asswpForm = filter_input(INPUT_POST, 'val_form', FILTER_SANITIZE_STRING );
            $asswpWhats = filter_input(INPUT_POST, 'val_whats', FILTER_SANITIZE_STRING );
            
            if($asswpForm == 'formulario') :
                $asswp_identifica = "Contato pelo email";
            endif;

            if($asswpWhats == 'api-whatsapp') :
                $asswp_identifica = "Contato pelo WhatsApp";
            endif;
            
            if(empty($asswpAssunto)):
                $asswpAssunto = 'Quero agendar uma consulta';
            endif;

            if(empty($asswpMsg)):
                $asswpMsg = 'Vazio';
            endif;

            include($_SERVER['DOCUMENT_ROOT'].'solucoes/wp-load.php');

            global $wpdb;

            $asswp_db   = apply_filters( 'asswp_database', $wpdb );
            $table_name = $asswp_db->prefix.'asswp_assinantes';
            
            $data = array(
                'data' => $asswpData,
                'nome' => $asswp_nome,
                'email' => $asswp_email,
                'telefone' => $asswpTel,
                'assunto' => $asswpAssunto,
                'mensagem' => $asswpMsg,
                'form' => $asswp_identifica,
            );
            
            $format = null;
                    
            if($wpdb->insert( $table_name, $data, $format )) :
            
                $subject  = '--';
                $asswp_send_email = '--';
                $copy = '--';
            
                $to = array(
                    $asswp_send_email,
                    $copy,
                );

                if($asswpForm == 'formulario') : 
                        
                    $body = '<p>Olá meu nome é <strong>'.$asswp_nome.'</strong>, quero agendar uma consulta.<p><br>
                            <h4>Meus dados:</h4>
                            <p><strong>Nome: </strong>'.$asswp_nome.'</p>
                            <p><strong>E-mail: </strong>'.$asswp_email.'</p>
                            <p><strong>Telefone: </strong>'.$asswpTel.'</p>                         
                            <h4>Assunto:</h4><p>'.$asswpAssunto.'</p>
                            <h4>Mensagem:</h4><p>'.$asswpMsg.'</p>
                            Data: '.$asswpData.'
                    
                    ';
                    $headers = array('Content-Type: text/html; charset=UTF-8','De: grupohoren.com.br/solucoes');
                   
                    if(wp_mail( $to, $subject, $body, $headers )) :
            
                        wp_safe_redirect(home_url( '/obrigado' ) );
                        exit;
            
                    else :
                        
                        wp_safe_redirect(home_url( '?er=send' ) );
                        exit;
            
                    endif;
            
                endif;
            
                if($asswpWhats == 'api-whatsapp') : 
            
                    $subject = 'Contato pelo WhatsApp LP - Quero agendar uma consulta';
                    
                    $body = '<p>Olá meu nome é <strong>'.$asswp_nome.'</strong>, quero agendar uma consulta<p><br>
                            <h4>Meus dados:</h4>
                            <p><strong>Nome: </strong>'.$asswp_nome.'</p>
                            <p><strong>E-mail: </strong>'.$asswp_email.'</p>
                            <p><strong>Telefone: </strong>'.$asswpTel.'</p>

                            Data: '.$asswpData.'
                    
                    ';
                    $headers = array('Content-Type: text/html; charset=UTF-8','De: grupohoren.com.br/solucoes');
                   
                    if(wp_mail( $to, $subject, $body, $headers )) :
            
                        wp_safe_redirect(home_url( '/whatsapp' ) );
                        exit;
            
                    else :
                        
                        wp_safe_redirect(home_url( '?er=send' ) );
                        exit;
            
                    endif;                
            
                endif;

            else :

                wp_safe_redirect(home_url( '?er=error' ) );
                exit;

            endif;
            
         }

    }
    
}
asswp_check_assi_subscribers::get_instance();