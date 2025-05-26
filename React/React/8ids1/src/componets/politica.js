import React from 'react';
import { useNavigate } from 'react-router-dom';
import styles from './Politica.module.css'; // Importa los estilos

function Politica() {
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

      {/* Contenedor principal de Política de Privacidad */}
      <header className={styles.headerContainer}>
        <div className={styles.headerContent}>
          <div className={styles.headerText}>
            <h2>🔒 Política de Privacidad</h2>
            <p>
              En <strong>MEDICONNECT</strong>, nos comprometemos a proteger la privacidad y seguridad de la información personal de nuestros usuarios. 
              Esta política describe cómo recopilamos, utilizamos y protegemos los datos personales que obtenemos a través de nuestros servicios en línea.
            </p>
            <br />
            <h3>📋 1. Información que recopilamos</h3>
            <p>- <strong>Datos personales:</strong> Nombre, dirección de correo electrónico, número de teléfono y fecha de nacimiento.</p>
            <p>- <strong>Información médica:</strong> Historial clínico y citas médicas, únicamente con fines de atención médica.</p>
            <p>- <strong>Datos de uso:</strong> Información sobre cómo utilizas nuestra plataforma para mejorar la experiencia del usuario.</p>
            <br />
            <h3>🎯 2. Uso de la información</h3>
            <p>Utilizamos tus datos para:</p>
            <ul>
              <li>✅ Proveer y gestionar servicios médicos.</li>
              <li>✅ Procesar citas y consultas.</li>
              <li>✅ Personalizar la experiencia del usuario.</li>
              <li>✅ Cumplir con obligaciones legales y regulatorias.</li>
            </ul>
            <br />
            <h3>🛡️ 3. Protección de la información</h3>
            <p>
              Implementamos medidas de seguridad técnicas y organizativas para proteger tus datos contra acceso no autorizado, alteración o divulgación.
            </p>
            <br />
            <h3>🔄 4. Compartir información</h3>
            <p>No compartimos tu información personal con terceros, salvo en los siguientes casos:</p>
            <ul>
              <li>✅ Con profesionales médicos involucrados en tu atención.</li>
              <li>✅ Cumplimiento de obligaciones legales.</li>
              <li>✅ Con proveedores de servicios que nos ayudan a operar la plataforma (bajo acuerdos de confidencialidad).</li>
            </ul>
            <br />
            <h3>📅 5. Derechos del usuario</h3>
            <p>Como usuario, puedes:</p>
            <ul>
              <li>✅ Acceder, rectificar o eliminar tus datos personales.</li>
              <li>✅ Restringir u oponerte al tratamiento de tus datos.</li>
              <li>✅ Retirar el consentimiento en cualquier momento.</li>
            </ul>
            <br />
            <h3>💡 6. Cambios a esta política</h3>
            <p>
              Nos reservamos el derecho a actualizar esta Política de Privacidad. Notificaremos cualquier cambio a través de nuestra plataforma.
            </p>
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

export default Politica;