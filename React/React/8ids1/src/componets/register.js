import React, { useState } from 'react';
import axios from 'axios';
import Image from 'react-bootstrap/Image';
import { useNavigate } from 'react-router-dom';
import styles from './Register.module.css';

const RegistrarPaciente = () => {
  const [nombre, setNombre] = useState('');
  const [ApPat, setApPat] = useState('');
  const [ApMat, setApMat] = useState('');
  const [tele, setTele] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [message, setMessage] = useState('');

  const navigate = useNavigate();

  // Aquí deberías modificar el código que maneja el registro del paciente

const handleSubmit = async (event) => {
  event.preventDefault();
  
  try {
    const response = await axios.post('http://127.0.0.1:8000/api/register', {
      nombre,
      ApPat,
      ApMat,
      tele,
      email,
      password
    });
    
    if (response.data.message === 'Paciente registrado correctamente') {
      setMessage('Registro exitoso. Redirigiendo al login...');
      setTimeout(() => navigate('/login'), 3000);
    } else {
      setMessage('Error en el registro.');
    }
  } catch (error) {
    setMessage('Error al conectar con el servidor.');
    console.error(error);
  // Mostrar más detalles del error en la consola
  if (error.response) {
    // Si el servidor responde con un error, muestra la respuesta
    console.error('Error en la respuesta del servidor:', error.response);
  } else if (error.request) {
    // Si no se recibió respuesta del servidor
    console.error('No se recibió respuesta del servidor:', error.request);
  } else {
    // Cualquier otro error (por ejemplo, errores en la configuración de la solicitud)
    console.error('Error al realizar la solicitud:', error.message);
  }
}
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

      {/* Formulario de Registro */}
      <div className={styles.loginContainer}>
        <div className={styles.loginContent}>
          <div className={styles.loginFormContainer}>
          <br></br>  <br></br>  <br></br>  <br></br>  <br></br>
            <div className={styles.loginForm}>
              <div className={styles.formHeader}>
                <Image
                  src="../img/usuario.png"
                  fluid
                  className={styles.doctorIcon}
                />
                <h1 className={styles.registroo}>Registro</h1>
              </div>
              <form onSubmit={handleSubmit}>
                <div className={styles.formField}>
                  <input
                    id="nombre"
                    className={styles.input}
                    type="text"
                    value={nombre}
                    onChange={(e) => setNombre(e.target.value)}
                    required
                  />
                  <span htmlFor="nombre">Nombre</span>
                </div>
                <br></br>
                <div className={styles.formField}>
                  <input
                    id="ApPat"
                    className={styles.input}
                    type="text"
                    value={ApPat}
                    onChange={(e) => setApPat(e.target.value)}
                    required
                  />
                  <span htmlFor="ApPat">Apellido Paterno</span>
                </div>
                <br></br>
                <div className={styles.formField}>
                  <input
                    id="ApMat"
                    className={styles.input}
                    type="text"
                    value={ApMat}
                    onChange={(e) => setApMat(e.target.value)}
                    required
                  />
                  <span htmlFor="ApMat">Apellido Materno</span>
                </div>
                <br></br>
                <div className={styles.formField}>
                  <input
                    id="tele"
                    className={styles.input}
                    type="text"
                    value={tele}
                    onChange={(e) => setTele(e.target.value)}
                    required
                  />
                  <span htmlFor="tele">Teléfono</span>
                </div>
                <br></br>
                <div className={styles.formField}>
                  <input
                    id="email"
                    className={styles.input}
                    type="email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    required
                  />
                  <span htmlFor="email">Email</span>
                </div>
                <br></br>
                <div className={styles.formField}>
                  <input
                    id="password"
                      autoComplete="off"
                    className={styles.input}
                    type="password"
                      
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    required
                  />
                  <span htmlFor="password">Contraseña</span>
                </div>

                {message && <p className="text-danger">{message}</p>}

                <div>
                  <br />
                  <center>
                    <button className={styles.button} type="submit">
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
};

export default RegistrarPaciente;
