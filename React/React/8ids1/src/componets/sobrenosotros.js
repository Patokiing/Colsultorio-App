import React from 'react';
import { useNavigate } from 'react-router-dom';
import styles from './SobreNosotros.module.css'; // Importa los estilos

function SobreNosotros() {
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

      {/* Contenido principal */}
      <header className={styles.headerContainer}>
        <div className={styles.headerContent}>
          <div className={styles.headerText}>
            <h2>¿Quiénes Somos?</h2>
            <p>
              En el <strong>Centro Médico Integral</strong>, nos dedicamos a brindar atención médica de calidad, 
              combinando tecnología de vanguardia con un equipo de profesionales altamente capacitados. 
              Desde nuestra fundación, hemos trabajado con el compromiso de ofrecer servicios de salud 
              centrados en el bienestar y la recuperación integral de nuestros pacientes.
            </p>
            <p>
              Contamos con instalaciones modernas, áreas especializadas y programas de prevención, 
              diagnóstico y tratamiento adaptados a las necesidades de cada persona.
            </p>
          </div>
          <div className={styles.headerImage}>
            <img src="/../img/quienes.jpg" alt="Servicios del hospital" />
          </div>
        </div>
      </header>

      {/* Misión, Visión, Valores y Razones para elegirnos */}
      <div className={styles.headerContainer}>
        <div className={styles.headerContent}>
          <div className={styles.headerText}>
            <h3>🎯 Misión</h3>
            <p>
              Proveer servicios de salud de excelencia, con un enfoque humano y ético, garantizando 
              atención oportuna, segura y efectiva. Nos esforzamos por mejorar la calidad de vida de nuestros 
              pacientes a través de tratamientos innovadores, educación en salud y atención personalizada.
            </p>

            <h3>👁️ Visión</h3>
            <p>
              Ser reconocidos como el hospital líder en atención médica integral de la región, distinguiéndonos 
              por la calidad de nuestros servicios, la calidez en el trato y la innovación tecnológica al servicio de la salud.
            </p>

            <h3>❤️ Nuestros Valores</h3>
            <ul>
              <li>Compromiso con la vida</li>
              <li>Ética profesional</li>
              <li>Empatía y respeto</li>
              <li>Innovación continua</li>
              <li>Trabajo en equipo</li>
            </ul>

            <h3>🧑‍⚕️ ¿Por qué elegirnos?</h3>
            <ul>
              <li>Citas en Línea</li>
              <li>Médicos especialistas certificados</li>
              <li>Equipos de última tecnología</li>
              <li>Planes de salud personalizados</li>
              <li>Programas de prevención y bienestar</li>
            </ul>
          </div>
          <div className={styles.headerImage}>
            <img src="/../img/servi.jpeg" alt="Atención médica" />
          </div>
        </div>
      </div>

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

export default SobreNosotros;