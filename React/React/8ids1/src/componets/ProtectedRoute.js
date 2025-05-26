import React, { useContext } from 'react';
import { Navigate, Outlet } from 'react-router-dom';
import { useUser } from './UserContext';  // Importa el hook useUser

const ProtectedRoute = () => {
  const { user } = useUser();  // Accede al contexto de usuario

  // Si no hay usuario autenticado, redirige al login
  if (!user) {
    return <Navigate to="/login" />;
  }

  // Si el usuario está autenticado, renderiza el componente solicitado
  return <Outlet />;
};

export default ProtectedRoute;