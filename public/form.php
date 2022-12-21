<?php

function asswp_form_register_form(){
    
    ?>
        
    <label>Seu nome:
        <input type="text" name="asswp_nome" required />
    </label>
    <label>Seu e-mail:
        <input type="email" name="asswp_email" required />
    </label>
    <label>Telefone/WhatsApp:
        <input type="text" name="asswp_fone" required />
    </label>
    <label class="some">Assunto:
        <input type="text" name="asswp_assunto" />
    </label>
    <label class="some">Mensagem:
        <textarea name="asswp_msg" cols="40" rows="10"></textarea>
    </label>
    <input type="hidden" name="val_form" value="formulario" />
    <input id="btSubmit" type="submit" name="asswp_submit" value="Agendar consulta" class="bt2" />
    
    <?php
    
}
add_shortcode('asswp_form', 'asswp_form_register_form');

function asswp_form_register_form_whats(){
    
    ?>
        
    <label>Seu nome:
        <input type="text" name="asswp_nome" required />
    </label>
    <label>Seu e-mail:
        <input type="email" name="asswp_email" required />
    </label>
    <label>Telefone/WhatsApp:
        <input type="text" name="asswp_fone" required />
    </label>   
    <input type="hidden" name="val_whats" value="api-whatsapp" />
    <input id="submit" type="submit" name="asswp_submit" value="Chamar no WhatsApp" class="bt-whats" />
    
    <?php
    
}
add_shortcode('asswp_form_whats', 'asswp_form_register_form_whats');
