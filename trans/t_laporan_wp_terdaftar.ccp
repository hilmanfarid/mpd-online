<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="None" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_laporan_piutang_pajak" wizardCaption="Search T Payment Receipt " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_laporan_wp_terdaftar.ccp" PathID="t_laporan_piutang_pajak" pasteActions="pasteActions">
			<Components>
				<Button id="7" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" PathID="t_laporan_piutang_pajakButton1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="21" urlType="Relative" enableValidation="True" isDefault="False" name="Button2" PathID="t_laporan_piutang_pajakButton2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="9" fieldSourceType="DBColumn" dataType="Text" name="cetak_laporan" PathID="t_laporan_piutang_pajakcetak_laporan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ListBox id="23" visible="Yes" fieldSourceType="DBColumn" sourceType="SQL" dataType="Text" returnValueType="Number" name="kode_wilayah" wizardEmptyCaption="Select Value" PathID="t_laporan_piutang_pajakkode_wilayah" connection="ConnSIKP" fieldSource="kode_wilayah" required="True" _valueOfList="5" _nameOfList="5" dataSource="select p_business_area_id, business_area_name
from p_business_area ">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="24" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<TextBox id="25" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="vat_code" fieldSource="vat_code" required="False" caption="Jenis Pajak" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_laporan_piutang_pajakvat_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="27" fieldSourceType="DBColumn" dataType="Text" name="p_vat_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_laporan_piutang_pajakp_vat_type_id" fieldSource="p_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="28" urlType="Relative" enableValidation="True" isDefault="False" name="Button3" PathID="t_laporan_piutang_pajakButton3">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="29" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="p_account_status_id" wizardEmptyCaption="Select Value" PathID="t_laporan_piutang_pajakp_account_status_id" connection="ConnSIKP" dataSource="1;Terdaftar;2;Tutup" fieldSource="period_type" _valueOfList="2" _nameOfList="Tutup">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<TextBox id="30" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="vat_code_dtl" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_laporan_piutang_pajakvat_code_dtl" caption="Tipe Ayat">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="31" fieldSourceType="DBColumn" dataType="Text" name="p_vat_type_dtl_id" PathID="t_laporan_piutang_pajakp_vat_type_dtl_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="32" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nama_kecamatan" fieldSource="nama_kecamatan" required="True" caption="Kecamatan" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_laporan_piutang_pajaknama_kecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="34" fieldSourceType="DBColumn" dataType="Text" name="p_region_id_kecamatan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_laporan_piutang_pajakp_region_id_kecamatan" fieldSource="p_region_id_kecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="26" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nama_kelurahan" fieldSource="nama_kelurahan" required="True" caption="Kelurahan" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_laporan_piutang_pajaknama_kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="36" fieldSourceType="DBColumn" dataType="Text" name="p_region_id_kelurahan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_laporan_piutang_pajakp_region_id_kelurahan" fieldSource="p_region_id_kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Label id="22" fieldSourceType="DBColumn" dataType="Text" html="True" name="Label1" PathID="Label1">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_laporan_wp_terdaftar_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_laporan_wp_terdaftar.php" forShow="True" url="t_laporan_wp_terdaftar.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="10"/>
			</Actions>
		</Event>
	</Events>
</Page>
