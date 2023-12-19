SELECT u.name, u.surname, s.type ,u.mail, u.phone, p.num_street, p.street, c.code_postal, c.city from users u JOIN place p ON p.id = u.id JOIN city c ON c.code_insee = p.code_insee JOIN speciality s ON u.id_speciality = s.id
WHERE s.type='Orthopédiste' OR u.name = '' OR u.surname = '';

DELETE from users WHERE name = 'MACON';