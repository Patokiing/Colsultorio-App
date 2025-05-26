import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useParams } from 'react-router-dom';
import styles from './VerReceta.module.css'; // Importando el CSS Module

const VerReceta = () => {
  const { id } = useParams(); // Acceder al id de la URL
  const [receta, setReceta] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchReceta = async () => {
      try {
        const response = await axios.get(`http://127.0.0.1:8000/api/receta-alternativa/${id}`);
        setReceta(response.data);
      } catch (error) {
        setError('Error al cargar la receta.');
      } finally {
        setLoading(false);
      }
    };

    fetchReceta();
  }, [id]); // Dependencia del id

  if (loading) {
    return <div className={styles.loadingMessage}>Cargando receta...</div>;
  }

  if (error) {
    return <div className={styles.errorMessage}>{error}</div>;
  }

  return (
    <div className={styles.verRecetaPage}>
        <nav className={styles['top-bar']}>
                          <div className={styles['logo-container']}>
                            <img src="../img/logo.png" alt="Logo" className={styles.logo} />
                            <p className={styles['mediconnect-text']}>MEDICONNECT</p>
                          </div>
                  
                        
                        
                        </nav>
      <div className={styles.recetaContainer}>
        <h1>Receta para la Cita #{receta.cita_id}</h1>
        <div>
          <h3>Observaciones del Doctor</h3>
          <p>{receta.observaciones_doctor}</p>

          <h3>Medicamentos Recetados</h3>
          <ul>
            {receta.medicamentos.map((medicamento) => (
              <li key={medicamento.id}>
                {medicamento.descripcion} - Cantidad: {medicamento.pivot.cantidad}, Frecuencia: {medicamento.pivot.frecuencia}
              </li>
            ))}
          </ul>
        </div>
      </div>
    </div>
  );
};

export default VerReceta;