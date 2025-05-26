import React from 'react';
import { useNavigate } from 'react-router-dom';
import styles from './Bien.module.css'; // Importa el módulo CSS

function Bien() {
  const navigate = useNavigate();

  const goToLogin = () => {
    navigate('/login');
  };

  const goToRegister = () => {
    navigate('/register');
  };

  return (
    <div className={styles['bien-page']}>
      {/* Barra superior con el logo y los botones de Login y Registrar */}
      <nav className={styles['top-bar']}>
        <div className={styles['logo-container']}>
          <img src="../img/logo.png" alt="Logo" className={styles.logo} />
          <p className={styles['mediconnect-text']}>MEDICONNECT</p>
        </div>

     

        <div className={styles['nav-buttons']}>
          <button className={styles.button} onClick={goToLogin}>
            <span>Login</span>
          </button>
          <button className={styles.button} onClick={goToRegister}>
            <span>Registrar</span>
          </button>
        </div>
      </nav>

      <header className={styles['header-container']}>
        <div className={styles['header-content']}>
          <div className={styles['header-text']}>
            <h2>Citas en Línea</h2>
            <p>
              Agenda tus citas médicas en línea de manera rápida, segura y sin complicaciones. Disfruta de la comodidad de gestionar tu salud desde donde estés, sin tener
              que desplazarte. Nuestro sistema te permite elegir el horario que mejor se adapte a tu agenda, todo con solo unos clics.
            </p>
          </div>
          <div className={styles['header-image']}>
            <img src="/../img/head.jpg" alt="Servicios del hospital" />
          </div>
        </div>
      </header>
      <br />

      <div className={styles['especialidades-title']}>
        <h2>Especialidades Médicas</h2>
      </div>

      <div className={styles['cards-container']}>
        <div className={styles['card-container']}>
          <div className={styles.card}>
            <div className={styles['front-content']}>
              <img src="/../img/cardiologia.jpg" alt="Imagen de Cardiología" />
              <h3>Cardiología</h3>
            </div>
            <div className={styles.content}>
              <p className={styles.heading}>Cardiología</p>
              <p>Se encarga del diagnóstico y tratamiento de enfermedades del corazón y sistema circulatorio.</p>
            </div>
          </div>
        </div>

        <div className={styles['card-container']}>
          <div className={styles.card}>
            <div className={styles['front-content']}>
              <img src="/../img/dermatologia.jpg" alt="Imagen de Dermatología" />
              <h3>Dermatología</h3>
            </div>
            <div className={styles.content}>
              <p className={styles.heading}>Dermatología</p>
              <p>Se ocupa del diagnóstico, tratamiento y prevención de enfermedades de la piel, cabello y uñas.</p>
            </div>
          </div>
        </div>

        <div className={styles['card-container']}>
          <div className={styles.card}>
            <div className={styles['front-content']}>
              <img src="/../img/neurologia.jpeg" alt="Imagen de Neurología" />
              <h3>Neurología</h3>
            </div>
            <div className={styles.content}>
              <p className={styles.heading}>Neurología</p>
              <p>Especialidad médica que aborda trastornos del sistema nervioso central y periférico.</p>
            </div>
          </div>
        </div>

        <div className={styles['card-container']}>
          <div className={styles.card}>
            <div className={styles['front-content']}>
              <img src="/../img/pediatria.jpeg" alt="Imagen de Pediatría" />
              <h3>Pediatría</h3>
            </div>
            <div className={styles.content}>
              <p className={styles.heading}>Pediatría</p>
              <p>Se enfoca en el cuidado de la salud y enfermedades de los niños desde el nacimiento hasta la adolescencia.</p>
            </div>
          </div>
        </div>

        <div className={styles['card-container']}>
          <div className={styles.card}>
            <div className={styles['front-content']}>
              <img src="/../img/oftalmologia.jpeg" alt="Imagen de Pediatría" />
              <h3>Oftalmología</h3>
            </div>
            <div className={styles.content}>
              <p className={styles.heading}>Oftalmología</p>
              <p>Especialidad dedicada al diagnóstico y tratamiento de enfermedades de los ojos.</p>
            </div>
          </div>
        </div>

        <div className={styles['card-container']}>
          <div className={styles.card}>
            <div className={styles['front-content']}>
              <img src="/../img/Ginecologia.jpg" alt="Imagen de Pediatría" />
              <h3>Ginecología</h3>
            </div>
            <div className={styles.content}>
              <p className={styles.heading}>Ginecología</p>
              <p>Aborda la salud del sistema reproductor femenino y el seguimiento del embarazo.</p>
            </div>
          </div>
        </div>

        <div className={styles['card-container']}>
          <div className={styles.card}>
            <div className={styles['front-content']}>
              <img src="/../img/ortopedia.jpeg" alt="Imagen de Pediatría" />
              <h3>Ortopedia</h3>
            </div>
            <div className={styles.content}>
              <p className={styles.heading}>Ortopedia</p>
              <p>Se encarga del diagnóstico y tratamiento de trastornos del sistema musculoesquelético.</p>
            </div>
          </div>
        </div>

        <div className={styles['card-container']}>
          <div className={styles.card}>
            <div className={styles['front-content']}>
              <img src="/../img/urologia.jpg" alt="Imagen de Pediatría" />
              <h3>Urología</h3>
            </div>
            <div className={styles.content}>
              <p className={styles.heading}>Urología</p>
              <p>Se especializa en el diagnóstico y tratamiento del aparato urinario y el sistema reproductor masculino.</p>
            </div>
          </div>
        </div>
      </div>

      <br />

      <footer className={styles.footer}>
       <div className={styles['footer-section']}>
          <h4>Contacto</h4>
          <div className={styles['social-icons']}>
            <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer">
              <img src="../img/facebook.png" alt="Facebook" className={styles['footer-social-icon']} />
            </a>
            <a href="https://mail.google.com" target="_blank" rel="noopener noreferrer">
              <img src="../img/gmail.png" alt="Gmail" className={styles['footer-social-icon']} />
            </a>
            <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer">
              <img src="../img/instagram.png" alt="Instagram" className={styles['footer-social-icon']} />
            </a>
            <a href="https://www.google.com/maps" target="_blank" rel="noopener noreferrer">
              <img src="../img/maps.png" alt="Google Maps" className={styles['footer-social-icon']} />
            </a>
          </div>
        </div>
    <div className={styles['footer-section']}>
          <a href="/sobrenosotros">Sobre Nosotros</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <a href="/politica">Política de Privacidad</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="/terminos">Términos y Condiciones</a>
        </div>
        <div className={styles['footer-section']}>
          <p className={styles['footer-copyright']}>&copy; 2025 MEDICONNECT. Todos los derechos reservados.</p>
        </div>
      </footer>
    </div>
  );
}

export default Bien;