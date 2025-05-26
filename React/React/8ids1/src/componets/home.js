import React, { useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { useUser } from './UserContext';  // Importa el hook useUser para acceder al contexto
import styles from './Home.module.css';

function Home() {
  const { user, logoutUser } = useUser();  // Accede al contexto de usuario 
  const navigate = useNavigate();

  // Verificar si el usuario está autenticado cada vez que el componente se monta
  useEffect(() => {
    if (!user) {
      navigate('/login', { replace: true });  // Redirige al usuario a la página de inicio de sesión y reemplaza la entrada del historial
    }
  }, [user, navigate]);

  const goToCitas = () => {
    navigate('/cita');
  };

  const goToConsultar = () => {
    navigate('/consultarcitas');
  };

  const goToProfile = () => {
    navigate('/profile');  // Redirige a la vista de perfil
  };

  const goTocitasa = () => {
    navigate('/citasatendidas');  // Redirige a la vista de perfil
  };

  const handleLogout = () => {
    logoutUser();  // Cierra la sesión del usuario
    localStorage.removeItem('token');  // Elimina el token del localStorage
    navigate('/login', { replace: true });  // Redirige al usuario a la página de inicio de sesión y reemplaza la entrada del historial
  };

  return (
    <div className={styles.bienPage}>
      {/* Fondo con los círculos animados */}
      <div className={styles.rippleBackground}>
        <div className={`${styles.circle} ${styles.xlarge} ${styles.shade2}`}></div>
        <div className={`${styles.circle} ${styles.large} ${styles.shade3}`}></div>
      </div>

      {/* Barra superior */}
      <nav className={styles['top-bar']}>
        <div className={styles['logo-container']}>
          <img src="../img/logo.png" alt="Logo" className={styles.logo} />
          <p className={styles['mediconnect-text']}>MEDICONNECT</p>
        </div>

        {/* Personaliza el saludo con el nombre del usuario */}
        <center>
          <h1 className={styles['bienb']}>Bienvenido</h1>
        </center>

        <div className="nav-buttons">
          <button className={styles.button} onClick={goToProfile}>
            <span className={styles.box}>
              <img
                src="../img/usu.png"
                alt="Perfil"
                style={{ width: '20px', height: '20px', marginRight: '8px' }}
              />
              Perfil
            </span>
          </button>
          <button className={styles.button} onClick={handleLogout}>
            <span className={styles.box}>
              Cerrar Sesión
            </span>
          </button>
        </div>
      </nav>

      <br /><br /><br /><br /><br /><br /><br /><br />

      {/* Tarjetas */}
      <div className={styles.cardsContainer}>
        <div className={styles.card}>
          <div className={styles.cardContent}>
            <div className={styles.cardTitle}>Reservar Cita</div>
            <p className={styles.cardDescription}>
              Agenda tu próxima cita con facilidad. Elige la especialidad, la fecha y hora que más te convengan.
            </p>
            <button className={styles.caca} onClick={goToCitas}>
              Reservar
            </button>
          </div>
        </div>

        <div className={styles.card}>
          <div className={styles.cardContent}>
            <div className={styles.cardTitle}>Citas Reservadas</div>
            <p className={styles.cardDescription}>
              Consulta todas las citas que has reservado, incluyendo detalles y estado de las mismas.
            </p>
            <button className={styles.caca} onClick={goToConsultar}>Consultar</button>
          </div>
        </div>

        <div className={styles.card}>
          <div className={styles.cardContent}>
            <div className={styles.cardTitle}>Historial de Citas</div>
            <p className={styles.cardDescription}>
              Consulta el historial completo de tus citas pasadas, incluyendo médicos, fechas y detalles importantes.
            </p>
            <button className={styles.caca} onClick={goTocitasa}>Consultar</button>
          </div>
        </div>
      </div>

      <br></br><br></br><br></br><br></br>

      {/* Pie de página */}
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
          <a href="/sobrenosotros">Sobre Nosotros</a>&nbsp;&nbsp;
          <a href="/politica">Política de Privacidad</a>&nbsp;&nbsp;
          <a href="/terminos">Términos y Condiciones</a>&nbsp;&nbsp;
        </div>
        <div className={styles['footer-section']}>
          <p className={styles['footer-copyright']}>&copy; 2025 MEDICONNECT. Todos los derechos reservados.</p>
        </div>
      </footer>
    </div>
  );
}

export default Home;