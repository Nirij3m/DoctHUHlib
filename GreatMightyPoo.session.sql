SELECT u.name, u.surname, u.phone, u.mail, u.id_speciality, s.type, p.name as name_p, p.num_street, p.street, c.city, c.code_postal  from users u
    LEFT JOIN speciality s ON u.id_speciality = s.id
    LEFT JOIN place p ON u.id = p.id
    LEFT JOIN city c ON p.code_insee = c.code_insee WHERE u.id = :id