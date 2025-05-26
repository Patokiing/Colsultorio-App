import React from 'react';
import { useNavigate } from 'react-router-dom';
import styles from './Terminos.module.css'; // Importa los estilos

function Terminos() {
  const navigate = useNavigate();

  const goToLogin = () => {
    navigate('/login');
  };

  const goToRegister = () => {
    navigate('/register');
  };

  return (
    <div className={styles.bienPage}>
      {/* Barra superior */}
      <nav className={styles.topBar}>
        <div className={styles.logoContainer}>
          <img src="../img/logo.png" alt="Logo" className={styles.logo} />
          <p className={styles.mediconnectText}>MEDICONNECT</p>
        </div>
       
        <div className={styles.navButtons}>
          <button className={styles.button} onClick={goToLogin}>
            <span>Login</span>
          </button>
          <button className={styles.button} onClick={goToRegister}>
            <span>Registrar</span>
          </button>
        </div>
      </nav>

      {/* Contenedor principal de Términos y Condiciones */}
      <header className={styles.headerContainer}>
        <div className={styles.headerContent}>
          <div className={styles.headerText}>
            <h2>📜 Términos y Condiciones</h2>
            <p>
              Los siguientes Términos y Condiciones regulan el uso de la plataforma <strong>MEDICONNECT</strong>. Al utilizar nuestros servicios, aceptas cumplir con los términos descritos a continuación.
            </p>
            <br />
            <h3>📋 1. Aceptación de los términos</h3>
            <p>Al acceder o utilizar nuestros servicios, aceptas los términos y condiciones establecidos en este acuerdo.</p>
            <br />
            <h3>🎯 2. Uso adecuado de la plataforma</h3>
            <p>Te comprometes a utilizar la plataforma de forma legal, ética y respetuosa.</p>
            <br />
            <h3>🛡️ 3. Responsabilidad del usuario</h3>
            <p>Eres responsable del uso de la plataforma, asegurándote de que la información proporcionada es precisa y actualizada.</p>
            <br />
            <h3>🔄 4. Modificaciones a los términos</h3>
            <p>Nos reservamos el derecho de modificar los términos en cualquier momento. Te notificaremos sobre los cambios a través de la plataforma.</p>
            <br />
            <h3>📅 5. Limitación de responsabilidad</h3>
            <p>No nos responsabilizamos por cualquier daño, pérdida o perjuicio derivado del uso de la plataforma, salvo en los casos donde la ley disponga lo contrario.</p>
            <br />
          </div>
        </div>
      </header>

      {/* Pie de página */}
      <footer className={styles.footer}>
        <div className={styles.footerSection}>
          <h4>Contacto</h4>
          <div className={styles.socialIcons}>
            <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer">
              <img src="../img/facebook.png" alt="Facebook" className={styles.footerSocialIcon} />
            </a>
            <a href="https://mail.google.com" target="_blank" rel="noopener noreferrer">
              <img src="../img/gmail.png" alt="Gmail" className={styles.footerSocialIcon} />
            </a>
            <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer">
              <img src="../img/instagram.png" alt="Instagram" className={styles.footerSocialIcon} />
            </a>
            <a href="https://www.google.com/maps" target="_blank" rel="noopener noreferrer">
              <img src="../img/maps.png" alt="Google Maps" className={styles.footerSocialIcon} />
            </a>
          </div>
        </div>
        <div className={styles.footerSection}>
          <div className={styles.footerLinks}>
            <a href="/sobrenosotros">Sobre Nosotros</a>
            <a href="/politica">Política de Privacidad</a>
            <a href="/terms">Términos y Condiciones</a>
          </div>
        </div>
        <div className={styles.footerSection}>
          <p className={styles.footerCopyright}>&copy; 2025 MEDICONNECT. Todos los derechos reservados.</p>
        </div>
      </footer>
    </div>
  );
}

export default Terminos;