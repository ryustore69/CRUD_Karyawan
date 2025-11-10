# Cara Update ke GitHub

## 📤 Langkah-langkah Update ke GitHub

### 1. Cek Status Git

```bash
git status
```

Ini akan menampilkan file-file yang diubah atau file baru yang belum di-commit.

### 2. Tambahkan File ke Staging

**Tambahkan semua file yang diubah:**
```bash
git add .
```

**Atau tambahkan file tertentu saja:**
```bash
git add README.md
git add GITHUB_SETUP.md
```

### 3. Commit Perubahan

```bash
git commit -m "Deskripsi perubahan yang dilakukan"
```

**Contoh commit message yang baik:**
```bash
git commit -m "docs: Update README.md dengan dokumentasi lengkap"
git commit -m "feat: Tambah fitur pagination dengan opsi 5/10/50"
git commit -m "fix: Perbaiki error pagination URL"
git commit -m "style: Perbaiki tampilan button dengan Tailwind CSS"
```

### 4. Push ke GitHub

```bash
git push
```

**Atau jika pertama kali push:**
```bash
git push -u origin master
```

**Atau jika menggunakan branch main:**
```bash
git push -u origin main
```

---

## 🔄 Workflow Lengkap

```bash
# 1. Cek status
git status

# 2. Tambahkan file
git add .

# 3. Commit
git commit -m "Deskripsi perubahan"

# 4. Push ke GitHub
git push
```

---

## 📝 Contoh Update

### Update README.md

```bash
# 1. Edit README.md
# 2. Tambahkan ke staging
git add README.md

# 3. Commit
git commit -m "docs: Update README.md dengan instruksi lengkap"

# 4. Push
git push
```

### Update Multiple Files

```bash
# 1. Edit beberapa file
# 2. Tambahkan semua file
git add .

# 3. Commit
git commit -m "feat: Tambah fitur search dan filter"

# 4. Push
git push
```

---

## 🆘 Troubleshooting

### Error: "Your branch is ahead of 'origin/master'"

Ini berarti ada commit lokal yang belum di-push. Cukup jalankan:
```bash
git push
```

### Error: "Updates were rejected"

Ini berarti ada perubahan di GitHub yang belum ada di local. Pull dulu:
```bash
git pull origin master
# Atau
git pull origin main
```

Lalu push lagi:
```bash
git push
```

### Error: "Authentication failed"

**Solusi 1: Login via Browser**
- Buka GitHub di browser dan login
- Git akan menggunakan credential dari browser

**Solusi 2: Personal Access Token**
1. Buka GitHub Settings > Developer settings > Personal access tokens
2. Generate token baru
3. Gunakan token sebagai password saat push

**Solusi 3: SSH Key**
1. Generate SSH key: `ssh-keygen -t ed25519 -C "email@example.com"`
2. Tambahkan SSH key ke GitHub (Settings > SSH and GPG keys)
3. Ubah remote URL ke SSH:
```bash
git remote set-url origin git@github.com:username/repo.git
```

---

## 💡 Tips

1. **Commit Message yang Baik**
   - Gunakan format: `tipe: deskripsi`
   - Tipe: `feat`, `fix`, `docs`, `style`, `refactor`, `chore`
   - Contoh: `feat: Tambah fitur export CSV`

2. **Commit Sering**
   - Commit setiap fitur atau perbaikan yang selesai
   - Jangan tunggu sampai banyak perubahan

3. **Pull Sebelum Push**
   - Jika bekerja dalam tim, pull dulu sebelum push
   - `git pull origin master` sebelum `git push`

4. **Cek Status Sebelum Commit**
   - Selalu cek `git status` sebelum commit
   - Pastikan file yang di-commit sudah benar

---

## 📋 Checklist Update

- [ ] Edit file yang diperlukan
- [ ] Cek status dengan `git status`
- [ ] Tambahkan file dengan `git add .`
- [ ] Commit dengan message yang jelas
- [ ] Push ke GitHub dengan `git push`
- [ ] Verifikasi di GitHub bahwa update sudah masuk

---

**Selamat! Update Anda sudah di GitHub! 🎉**

