import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
import Image from 'react-bootstrap/Image';
import { useUser } from './UserContext';  // Importa el hook useUser
import styles from './Login.module.css';

function Login() {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const navigate = useNavigate();
  const { loginUser } = useUser();  // Accede a loginUser del contexto

  const loginValidate = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post('http://127.0.0.1:8000/api/login', {
        email: username,
        password: password,
      });

      if (response.data.acceso === 'Ok') {
        console.log('Datos del usuario:', response.data.user); 
        loginUser(response.data.user); // Aquí pasamos el usuario al contexto
        localStorage.setItem('token', response.data.token); // Guarda el token si es necesario
        navigate('/home');
      } else {
        setError(response.data.error);
        await axios.post('http://127.0.0.1:8000/api/log-failed-login', {
          email: username,
          ip: await getIpAddress(),
        });
      }
    } catch (error) {
      setError('Ocurrió un error en el servidor');
      console.error('Ocurrió un error: ', error);
    }
  };

  const getIpAddress = async () => {
    const response = await axios.get('https://api.ipify.org?format=json');
    return response.data.ip;
  };

  const goToRegister = () => {
    navigate('/register');
  };

  return (
    <div>
      {/* Barra superior con el logo y los botones de Login y Registrar */}
      <nav className={styles['top-bar']}>
        <div className={styles['logo-container']}>
          <img src="../img/logo.png" alt="Logo" className={styles.logo} />
          <p className={styles['mediconnect-text']}>MEDICONNECT</p>
        </div>

      
      
      </nav>

      {/* Formulario de Login */}
      <div className={styles.loginContainer}>
        <div className={styles.loginContent}>
          <div className={styles.loginFormContainer}>
            <div className={styles.loginForm}>
              <div className={styles.formHeader}>
                <Image
                  src="../img/usuario.png"
                  fluid
                  className={styles.doctorIcon}
                />
                <h1 className={styles.loginn}>Login</h1>
              </div>
              <form onSubmit={loginValidate}>
                <div className={styles.formField}>
                  <input
                    id="email"
                    className={styles.input}
                    type="email"
                    autoComplete="off"
                    value={username}
                    onChange={(e) => setUsername(e.target.value)}
                    required
                  />
                  <span htmlFor="email">Email</span>
                </div>
                <br />
                <div className={styles.formField}>
                  <input
                    autoComplete="off"
                    id="password"
                    className={styles.input}
                    type="password"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    required
                  />
                  <span htmlFor="password">Password</span>
                </div>

                {error && <p className="text-danger">{error}</p>}

                <div><br></br>
                  <center>
                    <button className={styles.button} type="submit">
                      Login
                    </button> &nbsp; &nbsp; &nbsp; &nbsp;
                    <button
                      className={styles.button}
                      type="button"
                      onClick={goToRegister}
                    >
                      Registrar
                    </button>
                  </center>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      {/* Footer */}
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

export default Login;