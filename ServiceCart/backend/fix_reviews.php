<?php
include "db.php";

echo "--- MIGRATING REVIEWS provider_id to match users.id ---\n";

$res = $conn->query("SELECT id, provider_name FROM reviews");
while ($row = $res->fetch_assoc()) {
    $review_id = $row['id'];
    $name = trim($row['provider_name']);
    
    // Find user ID for this name
    $stmt = $conn->prepare("SELECT id FROM users WHERE TRIM(name) = ? AND role = 'Provider' LIMIT 1");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $user_res = $stmt->get_result();
    if ($user_row = $user_res->fetch_assoc()) {
        $user_id = $user_row['id'];
        echo "Updating review id $review_id with provider_id $user_id (for name '$name')\n";
        $up = $conn->prepare("UPDATE reviews SET provider_id = ? WHERE id = ?");
        $up->bind_param("ii", $user_id, $review_id);
        $up->execute();
    } else {
        echo "No provider user found for name '$name' (review id $review_id)\n";
    }
}

echo "\n--- SYNCING providers table ratings ---\n";
// Update all provider ratings based on their reviews (joining by user ID)
$providers = $conn->query("SELECT p.email, u.id FROM providers p JOIN users u ON p.email = u.email WHERE u.role = 'Provider'");
while ($p = $providers->fetch_assoc()) {
    $email = $p['email'];
    $u_id = $p['id'];
    $update = $conn->prepare("UPDATE providers SET rating = (SELECT IFNULL(ROUND(AVG(rating), 1), 0.0) FROM reviews WHERE provider_id = ?) WHERE email = ?");
    $update->bind_param("is", $u_id, $email);
    $update->execute();
    echo "Updated rating for provider with email $email (user_id $u_id)\n";
}

echo "\ndone.\n";
?>
